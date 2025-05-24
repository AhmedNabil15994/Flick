<?php

namespace Modules\Influencer\Repositories\Dashboard;

;

use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Influencer\Entities\Campaign as Model;

class CampaignRepository extends CrudRepository
{
    /**
    * Status attribute in model
    * @var array
    */
    protected $fileAttribute = [
        "cover" => "cover"
    ];

    /**
     * Status attribute in model
     * @var array
     */
    protected array $statusAttribute = [
        "is_active"
    ];


    public function __construct()
    {
        parent::__construct(Model::class);
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
    //         $model->influencers()->attach($request->influencers);
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
    //     $model->influencers()->sync($request->influencers ?? []);
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
        return $query->with(["company"]);
    }
}
