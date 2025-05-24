<?php

namespace Modules\Influencer\Repositories\Frontend;

use Modules\Influencer\Entities\Influencer as Model;
use Illuminate\Http\Request;

class InfluencerRepository
{
    public $mode;

    public function __construct()
    {
        $this->model = Model::active()->with(["country",$this->getSocialRelationFromRequest(request()->social ?? "instagrams"),"tags"]);
    }
    
    public function getSocialRelationFromRequest($requestSocial)
    {
        switch($requestSocial){
            case 'youtube':
                $social = "youtubes";
                break;
            case 'tiktok':
                $social = "tiktoks";
                break;
            case 'twitch':
                $social = "twitches";
                break;
            default:
                $social = "instagrams";
                break;
        }

        return $social;
    }
    
    public function getSocialQueryWithRelation(Request $request, $query, $relation)
    {

        $query->whereHas($relation,function($query) use ($request, $relation){
            switch($relation){
                case 'twitches':
                    $query;
                    break;
                case 'youtubes':
                    $query->where(function($query) use ($request){
                        if($request->views_min){
                            $query->where('total_views','>=', ($request->total_views));
                        }
                        if($request->views_max){
                            $query->where('total_views','<=', ($request->total_views));
                        }
                    });

                default:
                    $query->where(function($query) use ($request){
                        if($request->followers_min){
                            $query->where('followers','>=', ($request->followers_min));
                        }
                        if($request->followers_max){
                            $query->where('followers','<=', ($request->followers_max));
                        }
                        if($request->average_views_min){
                            $query->where('avg_views','>=', ($request->average_views_min));
                        }
                        if($request->average_views_max){
                            $query->where('avg_views','<=', ($request->average_views_max));
                        }
                    });
            }
        });

        return $query;
    }
    
    public function getPaginated(Request $request)
    {
        return $this->model->where(function($query) use($request){
            $socialRelation = $this->getSocialRelationFromRequest($request->social);

            $query->has($socialRelation);
            $this->getSocialQueryWithRelation($request, $query, $socialRelation);

            if($request->search){
                $query->where(function($query) use($request){
                    foreach ((new Model)->translatable as $key) {
                        $query->orWhere($key . '->' . locale(), 'like', '%' . $request->search . '%');
                    }
                });
            }

            if($request->country_id){
                $query->where('country_id', $request->country_id);
            }

            if($request->country_id){
                $query->where('country_id', $request->country_id);
            }

            if($request->has_mail){
                $query->whereNotNull('email');
            }

        })->paginate(12);
        // dd($request->toArray());
        if ($request->event_invitation_id) {
            $query->where("status", true);
            $query->withCount(["invitations as is_invite"=>function ($query) use ($request) {
                $query->select(\DB::raw("IF(count(invitations.id) > 0 , 1 , 0) as is_invite "))
                      ->where("invitations.event_id", $request->event_invitation_id);
            }]);
            if ($request->not_invite) {
                $query->where("is_invite", 0);
            }
        }

        if(isset($request['req']['user_name']) && !empty($request['req']['user_name'])){
            $query->whereHas('instagrams',function($instagramQuery) use ($request){
                $instagramQuery->where('user_name',$request['req']['user_name']);
            })->orWhereHas('youtubes',function($instagramQuery) use ($request){
                $instagramQuery->where('user_name',$request['req']['user_name']);
            })->orWhereHas('tiktoks',function($instagramQuery) use ($request){
                $instagramQuery->where('user_name',$request['req']['user_name']);
            })->orWhereHas('twitches',function($instagramQuery) use ($request){
                $instagramQuery->where('user_name',$request['req']['user_name']);
            });
        }

        if(isset($request['req']['name']) && !empty($request['req']['name'])){
            $query->where('name','LIKE','%'.$request['req']['name'].'%');
        }

        if(isset($request['req']['mobile']) && !empty($request['req']['mobile'])){
            $query->where('contact_number','LIKE','%'.$request['req']['mobile'].'%');
        }

        if (is_array($request->input("req.tags"))) {
            $query->whereHas("tags", fn ($q) =>$q->where("tags.id", $request->input("req.tags")));
        }
        if ($request->input("req.country_id")) {
            $query->where("country_id", $request->input("req.country_id"));
        }
        if ($request->input("req.city_id")) {
            $query->where("city_id", $request->input("req.city_id"));
        }
        if ($request->input("req.state_id")) {
            $query->where("state_id", $request->input("req.state_id"));
        }
        return $query->with(["country","instagrams", "youtubes", "tiktoks","tags"]);
    }
}
