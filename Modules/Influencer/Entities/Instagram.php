<?php

namespace Modules\Influencer\Entities;

use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasTranslations;
use Modules\Influencer\Entities\Influencer;
use Modules\Core\Traits\Dashboard\CrudModel;

class Instagram extends Model
{
    use CrudModel;

    protected $guarded = ["id"];
    protected $dates   = [
        "latest_calling_at" ,
    ];

    protected $casts    = [
        "api_info" => "array" ,
        "stat_history"=> "array",
        "audience_genders"=> "array",
        "audience_ages" => "array",
        "audience_genders_per_age" => "array",
        "audience_types"=>"array" ,  
        // "audience_credibility"=> "array"
    ];

    public function influencer(){
        return $this->belongsTo(Influencer::class,"influencer_id");
    }

    public function workers(){
        return $this->belongsToMany(User::class , "instagram_workers", "instagram_id", "worker_id")
                    ->withTimestamps();
    }
}
