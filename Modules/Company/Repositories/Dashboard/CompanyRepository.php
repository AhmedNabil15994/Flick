<?php

namespace Modules\Company\Repositories\Dashboard;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Package\Entities\Package;
use Modules\Company\Entities\Company as Model;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class CompanyRepository extends CrudRepository
{

    /**
    * Status attribute in model
    * @var array
    */
    protected $fileAttribute = [
        "logo"     => "logo"
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
        $model->workers()->sync($request->workers ?? []);
        $model->tags()->sync($request->tags ?? []);

    }

    public function updateSubscription($request, $subscription=null)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $subscription->update($data);

            DB::commit();
            return $subscription;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function createSubscription($request, $model=null)
    {
        $package = Package::findOrFail($request->package_id);

        DB::beginTransaction();

        try {
            $subscription = $package->createSubscriptions($model->id, true, $request->only(["comment"]));
            DB::commit();
            return $subscription;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function QuerySubscriptionsTable($request, $model)
    {
        $query = $model->subscriptions();

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    public function findSubscriptionForUser($model, $id){
       return  $model->subscriptions()->where("id", $id)->firstOrFail();
    }

}
