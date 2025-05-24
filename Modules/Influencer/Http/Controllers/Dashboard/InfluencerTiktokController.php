<?php

namespace Modules\Influencer\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use Modules\Influencer\Entities\Influencer;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Influencer\Http\Requests\Dashboard\InfluencerTiktokRequest;
use Modules\Influencer\Transformers\Dashboard\InfluencerTiktokResource;
use Modules\Influencer\Repositories\Dashboard\InfluencerTiktokRepository;

class InfluencerTiktokController extends Controller
{
    use CrudDashboardController;


    protected $repository=InfluencerTiktokRepository::class;
    protected $view_path="influencer::dashboard.influencer_tiktok";
    protected $model_resource=InfluencerTiktokResource::class;
    protected $model=Influencer::class;
    protected $request=InfluencerTiktokRequest::class;
}
