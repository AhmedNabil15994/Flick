<?php

namespace Modules\Influencer\Repositories\Dashboard;

;

use Illuminate\Http\Request;
use Modules\Influencer\Entities\Twitch as Model;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class TwitchRepository extends CrudRepository
{
    /**
    * Status attribute in model
    * @var array
    */
    protected $fileAttribute = [
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
        if ($request->workers) {
            $model->workers()->attach($request->workers);
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
        $model->workers()->sync($request->workers ?? []);
    }

    public function updateStatistic($model, $type="api")
    {
        if (!$model->url) {
            return false;
        }

        $stat = \Modules\Core\Packages\Influencer\InfluencerStatistic::twitch()
                    ->setModel($model);

        if ($type == "api") {
            $stat->fetchDataApi(true)->saveData();
        } else {
            $stat->fetchDataFromFile();
        }
        $stat->updateModel();
        return true;
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
        if ($request->event_invitation_id) {
            $query->whereNotExists(function ($query) use ($request) {
                $query->select(DB::raw(1))
                ->from('invitations')
                ->join('influencers', function ($join) {
                    $join->on('influencers.id', '=', 'invitations.influencer_id')
                    ->where("influencers.status", 1);
                })
                ->whereRaw('twitches.influencer_id = invitations.influencer_id')
                ->whereRaw("invitations.event_id = ?", [$request->event_invitation_id]);
            });
        }

        if(isset($request['req']['user_name']) && !empty($request['req']['user_name'])){
            $query->where('user_name',$request['req']['user_name']);
        }

        if(isset($request['req']['name']) && !empty($request['req']['name'])){
            $query->whereHas('influencer',function($influencerQuery) use ($request) {
                $influencerQuery->where('name','LIKE','%'.$request['req']['name'].'%');
            });
        }

        if(isset($request['req']['mobile']) && !empty($request['req']['mobile'])){
            $query->whereHas('influencer',function($influencerQuery) use ($request) {
                $influencerQuery->where('contact_number','LIKE','%'.$request['req']['mobile'].'%');
            });
        }


        if ($type = $request->input("req.type")) {
            if ($request->input("req.start")) {
                $query->where($type, ">=", $request->input("req.start"));
            }
            if ($request->input("req.end")) {
                $query->where($type, "<=", $request->input("req.end"));
            }
        }

        foreach (["followers", "engagements", "avg_comments", "avg_views","avg_reels_plays" ] as $search) {
            if ($request->input("req.$search.start")) {
                $query->where($search, ">=", $request->input("req.$search.start"));
            }
            if ($request->input("req.$search.end")) {
                $query->where($search, "<=", $request->input("req.$search.end"));
            }
        }


        if ($request->input("req.country_id") || $request->input("req.state_id") || $request->input("req.city_id")) {
            $query->whereHas("influencer", function ($query) use ($request) {
                if ($request->input("req.country_id")) {
                    $query->where("influencers.country_id", $request->input("req.country_id"));
                }
                if ($request->input("req.city_id")) {
                    $query->where("influencers.city_id", $request->input("req.city_id"));
                }
                if ($request->input("req.state_id")) {
                    $query->where("influencers.state_id", $request->input("req.state_id"));
                }
            });
        }

        return $query->with(["influencer.city", "influencer.state"]);
    }
}
