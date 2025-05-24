<?php

namespace Modules\Package\Repositories\Dashboard;;

use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Package\Entities\Package as Model;

class PackageRepository extends CrudRepository
{
     /**
     * Status attribute in model
     * @var array
     */
    protected array $statusAttribute = [
        "status" ,
        "is_free"
    ];
    public function __construct()
    {
        parent::__construct(Model::class);
    }

}
