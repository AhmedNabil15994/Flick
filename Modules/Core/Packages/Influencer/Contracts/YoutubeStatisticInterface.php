<?php
namespace Modules\Core\Packages\Influencer\Contracts;

use Modules\Influencer\Entities\Youtube;

interface YoutubeStatisticInterface {

    public function setModel(Youtube $model);
    
    public function fetchDataApi($forceUpdate=false);

    public function updateModel();

    public function saveData();

    public function fetchDataFromFile();

    public function getData();

    public function getResponse();

    
}
