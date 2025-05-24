<?php

namespace Modules\Influencer\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Influencer\Entities\Youtube;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Influencer\Http\Requests\Dashboard\YoutubeRequest;
use Modules\Influencer\Transformers\Dashboard\YoutubeResource;
use Modules\Influencer\Repositories\Dashboard\YoutubeRepository;

class YoutubeController extends Controller
{
    use CrudDashboardController;


    protected $repository=YoutubeRepository::class;
    protected $view_path="influencer::dashboard.youtube";
    protected $model_resource=YoutubeResource::class;
    protected $model=Youtube::class;
    protected $request=YoutubeRequest::class;

    public function updateStat(Request $request, $id)
    {
        $model = $this->repository->findById($id);
        if ($this->repository->updateStatistic($model, $request->type)) {
            return \redirect()->back()->withMsg(__("influencer::dashboard.youtube.form.msg.success"));
        }
        return \redirect()->back()->withError(__("influencer::dashboard.youtube.form.msg.failed"));
    }
}
