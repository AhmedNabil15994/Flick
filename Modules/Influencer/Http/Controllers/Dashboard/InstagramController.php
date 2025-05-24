<?php

namespace Modules\Influencer\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Influencer\Entities\Instagram;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Influencer\Http\Requests\Dashboard\InstagramRequest;
use Modules\Influencer\Transformers\Dashboard\InstagramResource;
use Modules\Influencer\Repositories\Dashboard\InstagramRepository;

class InstagramController extends Controller
{
    use CrudDashboardController;


    protected $repository=InstagramRepository::class;
    protected $view_path="influencer::dashboard.instagram";
    protected $model_resource=InstagramResource::class;
    protected $model=Instagram::class;
    protected $request=InstagramRequest::class;


    public function updateStat(Request $request, $id){
       $model = $this->repository->findById($id);
       if($this->repository->updateStatistic($model, $request->type)){
         return \redirect()->back()->withMsg(__("influencer::dashboard.instagram.form.msg.success"));
       }
       return \redirect()->back()->withError(__("influencer::dashboard.instagram.form.msg.failed"));
    }
}
