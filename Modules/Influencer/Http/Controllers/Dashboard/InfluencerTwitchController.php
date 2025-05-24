<?php

namespace Modules\Influencer\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use Modules\Influencer\Entities\Influencer;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Influencer\Http\Requests\Dashboard\InfluencerTwitchRequest;
use Modules\Influencer\Transformers\Dashboard\InfluencerTwitchResource;
use Modules\Influencer\Repositories\Dashboard\InfluencerTwitchRepository;

class InfluencerTwitchController extends Controller
{
    use CrudDashboardController;


    protected $repository=InfluencerTwitchRepository::class;
    protected $view_path="influencer::dashboard.influencer_twitch";
    protected $model_resource=InfluencerTwitchResource::class;
    protected $model=Influencer::class;
    protected $request=InfluencerTwitchRequest::class;
}
