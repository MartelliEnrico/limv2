<?php 

Route::group(['before' => 'not_installed'], function()
{
    Route::get('login', 'LimManager\Controllers\AuthController@login');
    Route::post('login', 'LimManager\Controllers\AuthController@postLogin');
    Route::any('logout', 'LimManager\Controllers\AuthController@logout');

    Route::get('/', 'LimManager\Controllers\LimsController@index');
    Route::post('lims/{id}/reserve', ['uses' => 'LimManager\Controllers\LimsController@reserve', 'as' => 'lims.reserve']);
    Route::post('lims/{id}/persistent', ['uses' => 'LimManager\Controllers\LimsController@persistent', 'as' => 'lims.persistent']);
    Route::post('lims/{id}/reserve/remove', ['uses' => 'LimManager\Controllers\LimsController@remove', 'as' => 'lims.reserve.remove']);
    Route::post('lims/{id}/persistent/reset', ['uses' => 'LimManager\Controllers\LimsController@reset', 'as' => 'lims.persistent.reset']);
    Route::post('lims/{id}/disable', ['uses' => 'LimManager\Controllers\LimsController@disable', 'as' => 'lims.disable']);
    Route::resource('lims', 'LimManager\Controllers\LimsController');
});

Route::controller('/', 'LimManager\Controllers\InstallationController');