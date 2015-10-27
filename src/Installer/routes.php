<?php

Route::group(['as' => 'atlas.installer::'], function () {
    Route::get('/', ['as' => 'home', 'uses' => '\Atlas\Installer\Http\Controllers\InstallerController@welcome']);
});
