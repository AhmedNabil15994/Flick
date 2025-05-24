<?php

Route::group(['middleware' => config('core.route-middleware.frontend.auth')],function(){
Route::get("/", "HomeController@index")->name("frontend.home.index");
Route::post("/logout", "HomeController@logout")
            ->middleware("auth")
            ->name("frontend.home.logout");
          });


// Route::get('*', function(){
//     abort(404);
// });
