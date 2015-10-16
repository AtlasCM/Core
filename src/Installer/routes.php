<?php

Route::get('/', ['as' => 'home', 'uses' => '\Atlas\Core\Installer\Http\Controllers\InstallerController@welcome']);
