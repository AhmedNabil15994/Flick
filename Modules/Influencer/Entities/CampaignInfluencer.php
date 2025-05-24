<?php

namespace Modules\Influencer\Entities;

use Modules\Core\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class CampaignInfluencer extends Pivot
{
    use UsesUuid;
    protected $table = "campaign_influencers";
    protected $guarded = ["id"];
}
