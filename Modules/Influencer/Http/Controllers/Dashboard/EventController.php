<?php

namespace Modules\Influencer\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;

class EventController extends Controller
{
    use CrudDashboardController;

    public function refreshInvitationStatistics($model)
    {
        $model = $this->repository->findById($model);

        return Response()->json(['html' => $model ? view("influencer::dashboard.events.components.statistics",compact('model'))->render() : '']);
    }
    public function create(Request $request, $campaign)
    {
        $campaign = $this->repository->findCampaign($campaign);
        $model = $this->model;
        return $this->view('create', compact('model', "campaign"));
    }

    public function edit(Request $request, $campaign, $id)
    {
        $campaign = $this->repository->findCampaign($campaign);
        $model = $this->repository->findById($id);

        return $this->view('edit', compact('model', "campaign"));
    }

    public function addInfluencers(Request $request, $id)
    {
        $request->validate([
                   'ids' => 'required|array',
                   'ids.*' => 'required|exists:influencers,id',
               ]);
        $model = $this->repository->findById($id);
        try {
            $create = $this->repository->addInfluencers($model, $request->ids);

            if ($create) {
                return Response()->json([true , __('apps::dashboard.messages.created')]);
            }

            return Response()->json([false  , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }

        return $this->view('edit', compact('model', "campaign"));
    }


    public function show(Request $request, $campaign, $id)
    {
        $campaign = $this->repository->findCampaign($campaign);
        $model = $this->repository->findById($id);

        return $this->view('show', compact('model', "campaign"));
    }


    public function changeInfluencerStatus(Request $request, $event, $invitationId)
    {
        $model = $this->repository->findById($event);
        
        $invetation = $model->invitations()->findOrFail($invitationId);
        $invetation->status = $request->status;
        $invetation->save();
        return response()->json([]);
    }

    public function index(Request $request, $campaign)
    {
        $campaign = $this->repository->findCampaign($campaign);
        return $this->view('index', compact("campaign"));
    }
}
