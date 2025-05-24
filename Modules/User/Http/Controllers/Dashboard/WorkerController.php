<?php

namespace Modules\User\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\User\Entities\User as UserModel;
use Modules\User\Http\Requests\Dashboard\WorkerRequest;
use Modules\User\Transformers\Dashboard\WorkerResource;
use Modules\User\Repositories\Dashboard\WorkerRepository as User;
use Modules\Authorization\Repositories\Dashboard\RoleRepository as Role;

class WorkerController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('user::dashboard.workers.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->user->QueryTable($request));

        $datatable['data'] = WorkerResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $model = new UserModel;
        return view('user::dashboard.workers.create', compact("model"));
    }

    public function store(WorkerRequest $request)
    {
        try {
            $create = $this->user->create($request);

            if ($create) {
                return Response()->json([true , __('apps::dashboard.messages.created')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function show($id)
    {
        $model = $this->user->findById($id);
        $subscriptionModel = new \Modules\Package\Entities\Subscription();

        return view('user::dashboard.workers.show', compact('model',"subscriptionModel"));
    }

    public function edit($id)
    {
        $model = $this->user->findById($id);

        return view('user::dashboard.workers.edit', compact('model'));
    }

    public function editSubscription(SubscriptionRequest $request, $id, $subscription_id)
    {
        try {
            $model          = $this->user->findById($id);
            $subscription   = $this->user->findSubscriptionForUser($model, $subscription_id);
            $update = $this->user->updateSubscription($request, $subscription);

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
            $model          = $this->user->findById($id);
            $update = $this->user->createSubscription($request, $model);

            if ($update) {
                return Response()->json([true , __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }


    public function update(WorkerRequest $request, $id)
    {
        try {
            $update = $this->user->update($request, $id);

            if ($update) {
                return Response()->json([true , __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function selectToOptions(Request $request)
    {
        $options =  $this->user->getSelectedToOptions($request);
        return response()->json($options);
    }

    public function destroy($id)
    {
        try {
            $delete = $this->user->delete($id);

            if ($delete) {
                return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $deleteSelected = $this->user->deleteSelected($request);

            if ($deleteSelected) {
                return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
