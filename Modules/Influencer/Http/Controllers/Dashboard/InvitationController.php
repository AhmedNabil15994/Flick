<?php

namespace Modules\Influencer\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Illuminate\Http\Request;
use Modules\Influencer\Repositories\Dashboard\InvitationRepository;

class InvitationController extends Controller
{
    use CrudDashboardController;
    protected $repository = InvitationRepository::class;




    public function update_status(Request $request){
        $input = $request->all();
        if(!isset($input['status']) || empty($input['status'])){
            return Response()->json([false  , __('influencer::dashboard.events.select_status')]);
        }

        $updated = $this->repository->updateStatus($input);
        if(!$updated){
            return Response()->json([false  , __('influencer::dashboard.instagram.form.msg.failed')]);
        }
        return Response()->json([true , __('influencer::dashboard.instagram.form.msg.success')]);
    }

    public function update_invitation_status(Request $request){
        $input = $request->all();
        if(!isset($input['status']) || $input['status'] == null){
            return Response()->json([false  , __('influencer::dashboard.events.select_status')]);
        }
        $updated = $this->repository->findById($input['id']);
        if(!$updated){
            return Response()->json([false  , __('influencer::dashboard.instagram.form.msg.failed')]);
        }
        $updated->update(['invitation_status' => (int) $input['status']]);
        return Response()->json([true , __('influencer::dashboard.instagram.form.msg.success')]);
    }

    public function upload_video(Request $request) {
        $input = $request->all();
        $updated = $this->repository->findById($input['id']);
        if(!$updated){
            return Response()->json([false  , __('influencer::dashboard.instagram.form.msg.failed')]);
        }
        $updated = $this->repository->update($request,$input['id']);
        return Response()->json([true , __('influencer::dashboard.instagram.form.msg.success')]);
    }
}
