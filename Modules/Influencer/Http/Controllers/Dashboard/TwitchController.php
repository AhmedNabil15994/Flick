<?php

namespace Modules\Influencer\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use Modules\Influencer\Entities\Twitch;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Influencer\Http\Requests\Dashboard\TwitchRequest;
use Modules\Influencer\Transformers\Dashboard\TwitchResource;
use Modules\Influencer\Repositories\Dashboard\TwitchRepository;

class TwitchController extends Controller
{
    use CrudDashboardController;


    protected $repository=TwitchRepository::class;
    protected $view_path="influencer::dashboard.twitch";
    protected $model_resource=TwitchResource::class;
    protected $model=Twitch::class;
    protected $request=TwitchRequest::class;
}
