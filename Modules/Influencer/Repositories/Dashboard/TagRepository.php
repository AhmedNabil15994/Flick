<?php

namespace Modules\Influencer\Repositories\Dashboard;

;

use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Influencer\Entities\Tag as Model;

class TagRepository extends CrudRepository
{
    /**
    * Status attribute in model
    * @var array
    */
    protected $fileAttribute = [

    ];

    public function __construct()
    {
        parent::__construct(Model::class);
    }
}
