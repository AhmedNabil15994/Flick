<?php

Route::group(['prefix' => 'roles'], function () {

  	Route::get('/' ,'RoleController@index')
  	->name('dashboard.roles.index');

  	Route::get('datatable'	,'RoleController@datatable')
  	->name('dashboard.roles.datatable');

	Route::get('select-options', 'RoleController@selectToOptions')
	  ->name('dashboard.roles.show.options');

  	Route::get('create'		,'RoleController@create')
  	->name('dashboard.roles.create');

  	Route::post('/'			,'RoleController@store')
  	->name('dashboard.roles.store');

  	Route::get('{id}/edit'	,'RoleController@edit')
  	->name('dashboard.roles.edit');

  	Route::put('{id}'		,'RoleController@update')
  	->name('dashboard.roles.update');

  	Route::delete('{id}'	,'RoleController@destroy')
  	->name('dashboard.roles.destroy');

  	Route::get('deletes'	,'RoleController@deletes')
  	->name('dashboard.roles.deletes');

  	Route::get('{id}','RoleController@show')
  	->name('dashboard.roles.show');

});
