<?php

namespace Modules\Influencer\Http\Controllers\Frontend;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Influencer\Entities\Influencer;
use Modules\Influencer\Repositories\Frontend\InfluencerRepository;
use Modules\Influencer\Entities\{Event,Invitation,Campaign};
use Modules\Influencer\Transformers\Frontend\CampaignResource;

class InfluencerController extends Controller
{
    public $repo;

    public function __construct()
    {
        $this->repo = new InfluencerRepository();
    }

    public function ajaxIndex(Request $request){

        return response()->json(['html' => $this->getInfluencersView($request)]);
    }

    public function getInfluencersView(Request $request){

        $influencers = $this->repo->getPaginated($request);
        $social = $this->repo->getSocialRelationFromRequest($request->social);

        $user_id = auth()->id();

        $list =  Campaign::active()->whereHas('Company', function ($whereQuery) use ($user_id){
            $whereQuery->whereManagerId($user_id)->orWhereHas('workers',function($whereWorker) use ($user_id){
                $whereWorker->whereId($user_id);
            });
        })->whereHas('events',function($query){
            $query->Published();
        })->with(['events','events.influencers','events.influencers.instagrams'])->get();

        $campaigns = CampaignResource::collection($list)->jsonSerialize();

        return view("influencer::frontend.components.influencers.index",compact("influencers","social","campaigns"))->render();
    }

    public function my_campaigns(){
        $user_id = auth()->id();
        $lists =  Campaign::whereHas('Company', function ($whereQuery) use ($user_id){
            $whereQuery->whereManagerId($user_id)->orWhereHas('workers',function($whereWorker) use ($user_id){
                $whereWorker->whereId($user_id);
            });
        })->with(['events','events.influencers','events.influencers.instagrams'])->get();
        
        return view('influencer::frontend.my-campaigns', compact('lists'));
    }
    public function my_events($id){
        $user_id = auth()->id();
        $list =  $this->getCampaign($id);
        if(!$list){
            abort(404);
        }
        return view('influencer::frontend.my-events', compact('list'));
    }
    public function getCampaign($id){
        $id = un_hash_id($id);
        abort_if(empty($id), 404);
        $ttl = 86400;

        $user_id = auth()->id();

        $list =  Campaign::whereHas('Company', function ($whereQuery) use ($user_id){
            $whereQuery->whereManagerId($user_id)->orWhereHas('workers',function($whereWorker) use ($user_id){
                $whereWorker->whereId($user_id);
            });
        })->with(['events','events.influencers','events.influencers.instagrams'])->where('id',$id)->first();

        return $list;
    }
    public function getList($id){
        $user_id = auth()->id();
        $list =  $this->getCampaign($id);
        if(!$list){
            abort(404);
        }
        $relations = Instagram::whereHas('influencer',function($influencerQuery) use ($id){
            $influencerQuery->whPublished()->ereHas('campaigns',function($campaignQuery) use ($id){
                $campaignQuery->where('campaign_id',un_hash_id($id));
            });
        });
        $followers = $relations->sum('followers');
        $engagements = round( $relations->average('engagements') ,2);
        $quality_scores = round( $relations->average('quality_score') ,2);
        return view('influencer::frontend.my-influencers', compact('list','followers','engagements','quality_scores'));
    }

    public function updateInvitationStatus(Request $request,$invitation_id){
        $input = $request->all();
        $invitationObj = Invitation::find($invitation_id);
        if(!$invitationObj){
            abort(404);
        }

        $invitationObj->invitation_status = (int)$input['status'];
        $invitationObj->save();
        return response()->json("Updated Successfully", 200);
    }

    public function updateInfluencerEvents(Request $request,$influencerId){
        $user_id = auth()->id();
        
        $events = Event::Published()->whereHas('campaign',function($query) use ($user_id){
            $query->active();
            $query->whereHas('Company', function ($whereQuery) use ($user_id){
                $whereQuery->whereManagerId($user_id)->orWhereHas('workers',function($whereWorker) use ($user_id){
                    $whereWorker->whereId($user_id);
                });
            });
        })->pluck('id')->toArray();
        
        $influencer = Influencer::findOrFail($influencerId);
        Invitation::whereIn('event_id',$events)->where('influencer_id',$influencerId)->delete();

        foreach($request->events ?? [] as $event){
            if(in_array($event,$events)){
                Invitation::create([
                    'influencer_id' => $influencer->id,
                    'event_id' => $event,
                    'campaign_id' => Event::find($event)->campaign_id,
                    'invitation_status' => 0,
                ]);
            }
        }

        return response()->json("Updated Successfully", 200);
    }

    public function store_lists(Request $request)
    {
        // return response($request->all());
        $validated = $request->validate([
            'list_name' => 'required|max:255',
        ]);
        if ($request->ajax()) {
            try {

                $list = auth()->user()->lists()->create(['name' => $request->list_name]);
                return response()->json($list);
            } catch (\Exception $e) {
                throw $e;
                return response()->json([$e]);
            }
        }
    }
    public function sync_influancer(Request $request)
    {
        $validated = $request->validate([
            'influencer_id' => 'required|exists:influencers,id',
            'lists' => 'required',
        ]);
        try {
            $influencer_id = $request->influencer_id;
            $check_lists = Lists::whereIn('id', $request->lists)->where('client_id', auth()->id())->whereDoesntHave('influencers', function ($query) use($influencer_id) {
                $query->where('influencer_id', $influencer_id);
            })->get();
            $Influencer = Influencer::whereId($influencer_id)->first();
            $dd = $Influencer->lists()->attach($check_lists);
            $admins = User::where('id', 1)->first();
            foreach ($check_lists as $key => $value) {
                Notification::send($admins, new InfluencerList($value));
            }
            return response()->json(['success'=>" saved successfully."]);
        } catch (\Exception $e) {
            throw $e;
            return response()->json([$e]);
        }
    }
    public function update(ClientRequest $request)
    {
        // return Response($request->all());
        try {
            if ($request->filled('password')) {
                $check_password =  Hash::check($request->current_password , auth()->user()->password);
                if (!$check_password) {
                    return Response("wrong password");
                }
                $validated = $request->validated();
                $validated['password'] = bcrypt($request->password);
            }else {
                $validated = $request->safe()->only(['name', 'email', 'company', 'country_id', 'mobile']);
            }
            $client = Client::whereid(auth()->id())->update($validated);
            return response()->json("Updated Successfully", 200);
        } catch (\PDOException $e) {
            return response()->json("Something Wrong", 400);
        }
    }
}
