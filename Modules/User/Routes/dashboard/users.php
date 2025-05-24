<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'UserController@index')
    ->name('dashboard.users.index');

    Route::get('datatable', 'UserController@datatable')
    ->name('dashboard.users.datatable');

    Route::get('select-options', 'UserController@selectToOptions')
    ->name('dashboard.users.show.select_options');


    Route::get('/{id}/datatable-subscriptions', 'UserController@subscriptionsDatatable')
    ->name('dashboard.users.datatable.subscriptions');

    Route::get('create', 'UserController@create')
    ->name('dashboard.users.create');

    Route::post('/', 'UserController@store')
    ->name('dashboard.users.store');

    Route::post('/{id}/subscriptions', 'UserController@createSubscription')
    ->name('dashboard.users.store.subscription');

    Route::get('{id}/edit', 'UserController@edit')
    ->name('dashboard.users.edit');

    Route::put('{id}/edit/subscription/{subscription_id}', 'UserController@editSubscription')
    ->name('dashboard.users.edit.subscription');

    Route::put('{id}', 'UserController@update')
    ->name('dashboard.users.update');

    Route::delete('{id}', 'UserController@destroy')
    ->name('dashboard.users.destroy');

    Route::get('deletes', 'UserController@deletes')
    ->name('dashboard.users.deletes');

    Route::get('{id}', 'UserController@show')
    ->name('dashboard.users.show');
});

// workers 
Route::group(['prefix' => 'workers'], function () {
    Route::get('/', 'WorkerController@index')
    ->name('dashboard.workers.index');

    Route::get('datatable', 'WorkerController@datatable')
    ->name('dashboard.workers.datatable');

    Route::get('select-options', 'WorkerController@selectToOptions')
    ->name('dashboard.workers.show.select_options');


    Route::get('/{id}/datatable-subscriptions', 'WorkerController@subscriptionsDatatable')
    ->name('dashboard.workers.datatable.subscriptions');

    Route::get('create', 'WorkerController@create')
    ->name('dashboard.workers.create');

    Route::post('/', 'WorkerController@store')
    ->name('dashboard.workers.store');

    Route::post('/{id}/subscriptions', 'WorkerController@createSubscription')
    ->name('dashboard.workers.store.subscription');

    Route::get('{id}/edit', 'WorkerController@edit')
    ->name('dashboard.workers.edit');

    Route::put('{id}/edit/subscription/{subscription_id}', 'WorkerController@editSubscription')
    ->name('dashboard.workers.edit.subscription');

    Route::put('{id}', 'WorkerController@update')
    ->name('dashboard.workers.update');

    Route::delete('{id}', 'WorkerController@destroy')
    ->name('dashboard.workers.destroy');

    Route::get('deletes', 'WorkerController@deletes')
    ->name('dashboard.workers.deletes');

    Route::get('{id}', 'WorkerController@show')
    ->name('dashboard.workers.show');
});

