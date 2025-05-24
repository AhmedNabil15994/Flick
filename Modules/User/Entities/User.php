<?php

namespace Modules\User\Entities;

use Modules\User\Enum\UserType;
use Spatie\MediaLibrary\HasMedia;
use Modules\Area\Entities\Country;
use Illuminate\Support\Facades\Hash;
use Modules\Core\Traits\ScopesTrait;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Modules\Package\Entities\Subscription;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Modules\Core\Traits\ClearsResponseCache;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\DeviceToken\Traits\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\DeviceToken\Entities\DeviceToken;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use CrudModel{
        __construct as private CrudConstruct;
    }
    use ClearsResponseCache;

    use Notifiable , HasRoles , InteractsWithMedia,HasApiTokens;

    use SoftDeletes {
      restore as private restoreB;
    }
    protected $guard_name = 'web';
    protected $dates = [
      'deleted_at'
    ];

    protected $fillable = [
        'name', 'email', 'password', 'mobile' , 'image' , "type",
        "admin_approved", "is_verified", "phone_code", "country_id"
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setLogAttributes(['name', 'email', 'password', 'mobile' , 'image']);
    }

    public function restore()
    {
        $this->restoreB();
    }
    public function setPasswordAttribute($value)
    {
        if ($value === null || !is_string($value)) {
            return;
        }
        $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }

    public function mobileCode()
    {
        return $this->morphOne(MobileCode::class, 'user');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, "country_id");
    }

    public function getPhone()
    {
        return ($this->phone_code ?? "965") . $this->mobile;
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, "user_id");
    }

    public function currentSubscription()
    {
        return $this->hasOne(Subscription::class, "user_id")->latest("id");
    }

    public function scopeBaseType($query, $type)
    {
        $query->where("type", $type);
    }

    public function scopeWorker($query)
    {
        $query->whereIn("type", array_values(UserType::getWorkerType()));
    }

    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class, "user_id");
    }
}
