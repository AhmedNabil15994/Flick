<?php

namespace Modules\Company\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Company\Http\Requests\Dashboard\SubscriptionRequest;
use Modules\Company\Transformers\Dashboard\SubscriptionResource;

class CompanyController extends Controller
{
    use CrudDashboardController;

    public function subscriptionsDatatable(Request $request, $id){

        $model = $this->repository->findById($id);

        $datatable = DataTable::drawTable($request, $this->repository->QuerySubscriptionsTable($request, $model));

        $datatable['data'] = SubscriptionResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function editSubscription(SubscriptionRequest $request, $id, $subscription_id)
    {
        try {
            $model          = $this->repository->findById($id);
            $subscription   = $this->repository->findSubscriptionForUser($model, $subscription_id);
            $update = $this->repository->updateSubscription($request, $subscription);

            if ($update) {
                return Response()->json([true , __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }


    public function createSubscription(SubscriptionRequest $request, $id)
    {
        try {
            $model          = $this->repository->findById($id);
            $update = $this->repository->createSubscription($request, $model);

            if ($update) {
                return Response()->json([true , __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
