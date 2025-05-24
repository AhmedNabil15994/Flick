<?php

namespace Modules\Package\Entities;

use Modules\Core\Traits\UsesUuid;
use Modules\Company\Entities\Company;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use UsesUuid;
    protected $guarded = ["id"];
    protected $dates   = ["start_at", "end_at"];


    public function package(){
        return $this->belongsTo(Package::class);
    }

    public function user(){
        return $this->belongsTo(Company::class);
    }
}
