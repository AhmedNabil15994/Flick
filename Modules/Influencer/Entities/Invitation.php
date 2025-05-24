<?php

namespace Modules\Influencer\Entities;

use Modules\Core\Traits\UsesUuid;
use Modules\Influencer\Entities\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class Invitation extends Pivot
{
    use UsesUuid;
    protected $table = "invitations";
    protected $guarded = ["id"];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, "campaign_id");
    }

    public function influencer()
    {
        return $this->belongsTo(Influencer::class, "influencer_id");
    }

    public function event()
    {
        return $this->belongsTo(Event::class, "event_id");
    }


}
