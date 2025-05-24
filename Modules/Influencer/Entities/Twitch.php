<?php

namespace Modules\Influencer\Entities;

use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Influencer\Entities\Influencer;
use Modules\Core\Traits\Dashboard\CrudModel;

class Twitch extends Model
{
    use CrudModel;

    protected $guarded = ["id"];
    protected $dates   = [
        "latest_calling_at"
    ];

    public function influencer(){
        return $this->belongsTo(Influencer::class,"influencer_id");
    }

    public function workers(){
        return $this->belongsToMany(User::class , "twitch_workers", "twitch_id", "worker_id")
                    ->withTimestamps();
    }
}
