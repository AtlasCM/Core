<?php

Route::get('/', ['as' => 'home', 'uses' => '\Atlas\Installer\Http\Controllers\InstallerController@welcome']);
