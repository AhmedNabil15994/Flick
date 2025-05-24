<?php

namespace Modules\Influencer\Entities;

use Modules\Area\Entities\City;
use Modules\Area\Entities\State;
use Modules\Area\Entities\Country;
use Illuminate\Database\Eloquent\Model;
use Modules\Influencer\Entities\Tiktok;
use Illuminate\Notifications\Notifiable;
use Modules\Core\Traits\HasTranslations;
use Modules\Influencer\Entities\Youtube;
use Modules\Influencer\Entities\Instagram;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\DeviceToken\Traits\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Influencer extends Authenticatable
{
    use CrudModel;
    use SoftDeletes;
    use Notifiable;
    use HasApiTokens;
    use HasTranslations;
    protected $guarded = ["id"];
    public $translatable = ['name', 'bio'];

     /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        "socials" => "array" ,
        "contacts" => "array",  
    ];

    public function tags()
    {
        return  $this->belongsToMany(
            Tag::class,
            "influencer_tag",
            "influencer_id",
            "tag_id",
        );
    }

    public function InfluncerTag(){
        return $this->hasMany(InfluncerTag::class, "influencer_id");
    }

    public function instagrams(){
        return $this->hasMany(Instagram::class, "influencer_id");
    }

    public function youtubes(){
        return $this->hasMany(Youtube::class, "influencer_id");
    }

    public function tiktoks(){
        return $this->hasMany(Tiktok::class, "influencer_id");
    }

    public function twitches(){
        return $this->hasMany(Twitch::class, "influencer_id");
    }

    public function country(){
        return $this->belongsTo(Country::class, "country_id");
    }

    public function city(){
        return $this->belongsTo(City::class, "city_id");
    }

    public function state(){
        return $this->belongsTo(State::class, "state_id");
    }

    public function nationality(){
        return $this->belongsTo(Country::class, "nationality_id");
    }

    public function invitations(){
        return $this->hasMany(Invitation::class, "influencer_id");
    }

    public function campaigns()
    {
        return  $this->belongsToMany(Campaign::class, "invitations", "influencer_id", "campaign_id")
            ->using(Invitation::class)
            ->withTimestamps();
    }

    public function getAgeAttribute(){
        if($this->birth_date){
            return \Carbon\Carbon::parse($this->birth_date)->age;
        }
        return null;
    }
}
