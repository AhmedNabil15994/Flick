<?php

namespace Modules\Influencer\Repositories\Dashboard;

;

use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Influencer\Entities\Influencer as Model;

class InfluencerRepository extends CrudRepository
{
    /**
    * Status attribute in model
    * @var array
    */
    protected $fileAttribute = [
        "image" => "image"
    ];

    /**
     * Status attribute in model
     * @var array
     */
    protected array $statusAttribute = [
        "status" ,
        "has_instagram",
        "has_twitter",
        "has_tiktok",
        "has_twitch",
        "has_youtube",
    ];

    public function __construct()
    {
        parent::__construct(Model::class);
    }

     /**
     * Model created call back function
     *
     * @param mixed $model
     * @param \Illuminate\Http\Request $request is Request
     * @return void
     */
    public function modelCreated($model, $request): void
    {
        if ($request->tags) {
            $model->tags()->attach($request->tags);
        }
    }

    /**
     * Model update call back function
     *
     * @param mixed $model
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function modelUpdated($model, $request): void
    {
        $model->tags()->sync($request->tags ?? []);
    }

    /**
     * Append custom Code datatable
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function inDataTableSearch(&$query, $request)
    {
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
