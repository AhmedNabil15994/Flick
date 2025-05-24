<?php

//use Vsch\TranslationManager\Translator;


Route::group(['prefix' => '/' , 'middleware' => [ 'dashboard.auth']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.home');

    //  Route::group(['prefix' => 'translations'], function () {
//      Translator::routes();
    //  });

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});


Route::group(['prefix' => '/contacts-us' , 'middleware' => [ 'dashboard.auth'] , "as"=>"dashboard."], function () {
    Route::get('datatable', 'ContactUsController@datatable')
    ->name('contacts_us.datatable');

    Route::get('deletes', 'ContactUsController@deletes')
    ->name('contacts_us.deletes');

    Route::resource('/', 'ContactUsController')->names('contacts_us');
    Route::delete('/{id}', 'ContactUsController@destroy')->name('contacts_us.destroy');
});
