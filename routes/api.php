<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Influencer\Entities\Instagram;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::any("test", function(){
   
    \Modules\Core\Packages\Influencer\InfluencerStatistic::tiktok()
      ->setModel(\Modules\Influencer\Entities\Tiktok::first())
      ->fetchDataFromFile()
      ->updateModel()
      ->saveData()
    ;

    // dd($x->getReportById("634861e220dc51734da55104f"));
});