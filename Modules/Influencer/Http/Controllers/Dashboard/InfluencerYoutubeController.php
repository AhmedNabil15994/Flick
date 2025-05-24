<?php

namespace Modules\Influencer\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use Modules\Influencer\Entities\Influencer;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Influencer\Http\Requests\Dashboard\InfluencerYoutubeRequest;
use Modules\Influencer\Transformers\Dashboard\InfluencerYoutubeResource;
use Modules\Influencer\Repositories\Dashboard\InfluencerYoutubeRepository;

class InfluencerYoutubeController extends Controller
{
    use CrudDashboardController;


    protected $repository=InfluencerYoutubeRepository::class;
    protected $view_path="influencer::dashboard.influencer_youtube";
    protected $model_resource=InfluencerYoutubeResource::class;
    protected $model=Influencer::class;
    protected $request=InfluencerYoutubeRequest::class;
}
