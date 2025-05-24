<?php
namespace Modules\Core\Packages\Influencer\Contracts;

use Modules\Influencer\Entities\Tiktok;

interface TiktokStatisticInterface {

    public function setModel(Tiktok $model);
    
    public function fetchDataApi($forceUpdate=false);

    public function updateModel();

    public function saveData();

    public function fetchDataFromFile();

    public function getData();

    public function getResponse();

    
}
