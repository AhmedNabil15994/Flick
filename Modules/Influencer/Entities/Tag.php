<?php

namespace Modules\Influencer\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasTranslations;
use Modules\Core\Traits\Dashboard\CrudModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use CrudModel;
    use SoftDeletes;
    use HasTranslations;
    protected $guarded = ["id"];
    public $translatable = ['title', 'description'];

    public function influencers()
    {
        return  $this->belongsToMany(Influencer::class, "influencer_tag", "tag_id", "influencer_id");
    }
}
