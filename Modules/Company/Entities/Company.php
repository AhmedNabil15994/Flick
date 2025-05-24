<?php

namespace Modules\Company\Entities;

use Modules\User\Entities\User;
use Modules\Influencer\Entities\Tag;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasTranslations;
use Modules\Package\Entities\Subscription;
use Modules\Core\Traits\Dashboard\CrudModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use CrudModel;
    use SoftDeletes;
    use HasTranslations;
    protected $guarded = ["id"];
    public $translatable = ['name', 'description'];

    public function workers(){
        return $this->belongsToMany(User::class , "company_workers", "company_id", "worker_id")
                    ->withTimestamps();
    }

    public function manager(){
        return $this->belongsTo(User::class , "manager_id");
    }

    public function tags()
    {
        return  $this->belongsToMany(
            Tag::class,
            "company_tags",
            "company_id",
            "tag_id",
        );
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, "company_id");
    }

    public function currentSubscription()
    {
        return $this->hasOne(Subscription::class, "company_id")->latest("id");
    }
}
