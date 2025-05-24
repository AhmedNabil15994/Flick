<?php

namespace Modules\Influencer\Entities;

use Illuminate\Database\Eloquent\Model;
use IlluminateAgnostic\Arr\Support\Carbon;
use Modules\Core\Traits\HasTranslations;
use Modules\Influencer\Entities\Campaign;
use Modules\Influencer\Entities\Invitation;
use Modules\Core\Traits\Dashboard\CrudModel;

class Event extends Model
{
    use CrudModel;
    use HasTranslations;
    protected $guarded = ["id"];
    public $translatable = ['title', 'description', "coverage_message", "location_desc"];

    protected $dates   = [
        "start_at" ,
        "end_at"
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'helper_links' => 'array',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, "campaign_id");
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class, "event_id");
    }

    public function influencers()
    {
        return  $this->belongsToMany(Influencer::class, "invitations", "event_id", "influencer_id")
            ->withPivot(["status","campaign_id",'invitation_status',"approve_at","id",'video'])
            ->using(Invitation::class)
            ->withTimestamps();
    }

    public function scopePublished($query)
    {
        return  $query->where(function($query){
            $query->whereDate('start_at','<=', Carbon::now()->toDateString());
            $query->whereDate('end_at','>=', Carbon::now()->toDateString());
        });
    }
}
