<?php

namespace Modules\Influencer\Repositories\Dashboard;

;

use Illuminate\Http\Request;
use Modules\Influencer\Enum\InfluencerType;
use Modules\Influencer\Entities\Influencer as Model;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class InfluencerTwitchRepository extends CrudRepository
{
    /**
    * Status attribute in model
    * @var array
    */
    protected $fileAttribute = [
        "image" => "image"
    ];

    public function __construct()
    {
        parent::__construct(Model::class);
    }

    /**
     * Model created call back function
     *
     * @param mixed $model
     * @param \Illuminate\Http\Request $request is Request
     * @return void
     */
    public function modelCreated($model, $request): void
    {
        if ($request->tags) {
            $model->tags()->attach($request->tags);
        }
    }

    /**
     * Model update call back function
     *
     * @param mixed $model
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function modelUpdated($model, $request): void
    {
        $model->tags()->sync($request->tags ?? []);
    }


    public function globalScope($query, $from=null)
    {
        return $query->where("type", InfluencerType::TWITCH);
    }

    /**
     * Prepare Data before save or edit
     *
     * @param array $data
     * @param \Illuminate\Http\Request $request
     * @param boolean $is_create
     * @return array
     */
    public function prepareData(array $data, Request $request, $is_create = true): array
    {
        if ($is_create) {
            $data["type"]=InfluencerType::TWITCH;
        }
        if (isset($data["password"])) {
            $data["password"] = 
            bcrypt($data["password"]);
        }
        return $data;
    }
}
