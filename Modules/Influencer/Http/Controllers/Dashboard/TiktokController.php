<?php

namespace Modules\Influencer\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Influencer\Entities\Tiktok;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Influencer\Http\Requests\Dashboard\TiktokRequest;
use Modules\Influencer\Transformers\Dashboard\TiktokResource;
use Modules\Influencer\Repositories\Dashboard\TiktokRepository;

class TiktokController extends Controller
{
    use CrudDashboardController;


    protected $repository=TiktokRepository::class;
    protected $view_path="influencer::dashboard.tiktok";
    protected $model_resource=TiktokResource::class;
    protected $model=Tiktok::class;
    protected $request=TiktokRequest::class;

    public function updateStat(Request $request, $id)
    {
        $model = $this->repository->findById($id);
        if ($this->repository->updateStatistic($model, $request->type)) {
            return \redirect()->back()->withMsg(__("influencer::dashboard.tiktok.form.msg.success"));
        }
        return \redirect()->back()->withError(__("influencer::dashboard.tiktok.form.msg.failed"));
    }
}
