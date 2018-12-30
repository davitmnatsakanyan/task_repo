<?php

/** Task Routes */

use core\Route;

Route::get('/','TaskController@all');
Route::get('task/create','TaskController@create');
Route::post('task/save','TaskController@save');

/** Admin Auth Routes */
Route::get('admin/login','AuthController@getLogin');
Route::post('admin/login','AuthController@postLogin');
Route::get('admin/logout','AuthController@logout');

/** Admin Task Route */
Route::get('admin/index','Admin\\TaskController@index');
Route::get('admin/task/edit','Admin\\TaskController@edit');
Route::post('admin/task/update','Admin\\TaskController@update');
Route::get('admin/task/toggle_status','Admin\\TaskController@toggleStatus');

echo '<h2>404 Not Found</h2>';
