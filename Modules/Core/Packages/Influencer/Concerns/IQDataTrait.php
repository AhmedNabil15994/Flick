<?php

namespace Modules\Core\Packages\Influencer\Concerns;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Packages\Influencer\IQData\IQDataApi;

/**
 * Trait contain helper method for IQData
 */
trait IQDataTrait
{
    public $model;
    public $iQDataApi;
    public $response = [];
    public $callingApi=false;

    public function __construct()
    {
        $this->iQDataApi = new IQDataApi();
    }

    public function fetchDataFromFile()
    {
        $this->callingApi = false;
        $path =$this->getPathForFile();
        if (! Storage::disk("public")->exists($path)) {
            return $this->fetchDataApi()->saveData();
        }
        $this->response = json_decode(Storage::disk("public")->get($path), true);

        return $this;
    }

    public function updateModel()
    {
        if ($this->responseIsSuccess()) {
            $this->model->update(
                $this->getDataForModelFromResponse()
            );
        }
        return $this;
    }

    public function getData()
    {
        return $this->response;
    }

    public function saveData()
    {
        if ($this->responseIsSuccess()) {
            Storage::disk("public")->put($this->getPathForFile(), json_encode($this->response));
            ;
        }
        return $this;
    }

    public function end()
    {
        $this->response = [];
        $this->model    = null;
    }

    private function responseIsSuccess()
    {
        if (isset($this->response["success"]) && $this->response["success"] == true) {
            return true;
        }
        return false;
    }

    private function checkingCallingApi()
    {
        if (!$this->responseIsSuccess()) {
            throw \Modules\Core\Packages\Influencer\Exceptions\ThirdPartyCallingException::couldNotCallingThirdParty(
                get_class($this),
                json_encode($this->response)
            );
        }
    }

    private function getFromResponse($key, $default=null)
    {
        return Arr::get($this->response, $key, $default);
    }

    public function getLatestCallingApiDate()
    {
        return  $this->callingApi ? now() : $this->model->latest_calling_at;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
