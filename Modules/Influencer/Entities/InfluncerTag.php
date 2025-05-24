<?php

namespace Modules\Influencer\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasTranslations;
use Modules\Core\Traits\Dashboard\CrudModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfluncerTag extends Model
{
    protected $table = 'influencer_tag';
    public $fillable = ['influencer_id', 'tag_id'];
    public $timestamps = false;
}
