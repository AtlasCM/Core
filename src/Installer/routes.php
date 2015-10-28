<?php

Route::group(['as' => 'atlas.installer::'], function () {
    Route::get('/', ['as' => 'home', 'uses' => '\Atlas\Installer\Http\Controllers\InstallerController@welcome']);
    
    Route::get('environment', ['as' => 'env.create', 'uses' => '\Atlas\Installer\Http\Controllers\InstallerController@createEnv']);
    Route::post('environment', ['as' => 'env.store', 'uses' => '\Atlas\Installer\Http\Controllers\InstallerController@storeEnv']);
    
    Route::get('db/connect', ['as' => 'db.create', 'uses' => '\Atlas\Installer\Http\Controllers\InstallerController@createEnv']);
    Route::post('db/connect', ['as' => 'db.store', 'uses' => '\Atlas\Installer\Http\Controllers\InstallerController@storeEnv']);
    
    Route::get('db/install', ['as' => 'db.install', 'uses' => '\Atlas\Installer\Http\Controllers\InstallerController@createEnv']);
    Route::post('db/install', ['as' => 'db.migrate', 'uses' => '\Atlas\Installer\Http\Controllers\InstallerController@storeEnv']);
    
    Route::get('admin', ['as' => 'admin.create', 'uses' => '\Atlas\Installer\Http\Controllers\InstallerController@createEnv']);
    Route::post('admin', ['as' => 'admin.create', 'uses' => '\Atlas\Installer\Http\Controllers\InstallerController@storeEnv']);
});
