<?php

namespace Modules\Influencer\Repositories\Dashboard;

;

use Illuminate\Http\Request;
use Modules\Influencer\Entities\Campaign;
use Modules\Influencer\Enum\InvitationStatus;
use Modules\Influencer\Entities\Event as Model;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class EventRepository extends CrudRepository
{
    /**
    * Status attribute in model
    * @var array
    */
    protected $fileAttribute = [

    ];

    /**
     * Status attribute in model
     * @var array
     */
    protected array $statusAttribute = [
    ];


    public function __construct()
    {
        parent::__construct(Model::class);
    }

    public function findCampaign($id, $with=[])
    {
        return  Campaign::with($with)->findOrFail($id);
    }

    //  /**
    //  * Model created call back function
    //  *
    //  * @param mixed $model
    //  * @param \Illuminate\Http\Request $request is Request
    //  * @return void
    //  */
    // public function modelCreated($model, $request): void
    // {
    //     if ($request->influencers) {
    //         $model->influencers()->syncWithPivotValues($request->influencers, ["campaign_id"=> $model->campaign_id]);
    //     }
    // }

    // /**
    //  * Model update call back function
    //  *
    //  * @param mixed $model
    //  * @param \Illuminate\Http\Request $request
    //  * @return void
    //  */
    // public function modelUpdated($model, $request): void
    // {
    //     $model->influencers()->syncWithPivotValues($request->influencers, ["campaign_id"=> $model->campaign_id]);
    // }

      /**
     * Append custom Code datatable
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function inDataTableSearch(&$query, $request)
    {
        if ($request->campaign_id) {
            $query->where("campaign_id", $request->campaign_id);
        }
        return $query->withCount(["invitations",
         "invitations as invitations_accept_count"=> fn ($q) =>$q->where("status", InvitationStatus::ACCEPT),
        "invitations as invitations_refused_count"=> fn ($q) =>$q->where("status", InvitationStatus::REFUSED)]);
    }

     /**
     * Prepare Data before save or edit
     *
     * @param array $data
     * @param \Illuminate\Http\Request $request
     * @param boolean $is_create
     * @return array
     */
    public function prepareData(array $data, Request $request, $is_create = true): array
    {
        if (isset($request["helper_links"])) {
            $data["helper_links"] =array_values(array_filter($request->helper_links, function ($el) {
                return isset($el["key"]) && isset($el["link"]);
            }));
        }
        return $data;
    }

    public function addInfluencers($model, $ids)
    {
        $data = array_fill_keys($ids,["campaign_id"=> $model->campaign_id] );
        $model->influencers()->syncWithoutDetaching($data);
        return true;
    }
}
