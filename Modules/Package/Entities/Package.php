<?php

namespace Modules\Package\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasTranslations;
use Modules\Core\Traits\Dashboard\CrudModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    protected $guarded = ["id"];
    use CrudModel,SoftDeletes, HasTranslations;
    public $translatable = ['title', 'description'];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, "package_id");
    }

    public function createSubscriptions($company_id, $from_admin=false, $attribute=[]){
        $now    = now();
        $data  = [
            "from_admin" => $from_admin , 
            "price"      => $this->price ,
            "start_at"   => $now , 
            "end_at"     => $now->copy()->addDay($this->duration),
            "is_free"    => $this->price <=0,
            "company_id"    => $company_id ,
            "is_default" => true ,
            "number_of_influencers" => $this->number_of_influencers,
        ];

        $data  = array_merge($data, $attribute);

        $subscription = $this->subscriptions()->create($data);
        Subscription::where("company_id", $company_id)->where("id", "!=", $subscription->id)->update(["is_default"=>false]);
        return $subscription;
    }

}
