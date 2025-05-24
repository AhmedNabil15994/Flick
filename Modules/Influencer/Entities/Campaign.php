<?php

namespace Modules\Influencer\Entities;

use Modules\User\Entities\User;
use Modules\Company\Entities\Company;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasTranslations;
use Modules\Core\Traits\Dashboard\CrudModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Influencer\Entities\CampaignInfluencer;

class Campaign extends Model
{
    use CrudModel;
    use SoftDeletes;
    use HasTranslations;
    protected $guarded = ["id"];
    public $translatable = ['title', 'description'];

    public function company()
    {
        return $this->belongsTo(Company::class, "company_id");
    }

    public function events(){
        return $this->hasMany(Event::class,'campaign_id');
    }

    public function influencers()
    {
        return  $this->belongsToMany(Influencer::class, "campaign_influencers")
            ->using(CampaignInfluencer::class)
            ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
