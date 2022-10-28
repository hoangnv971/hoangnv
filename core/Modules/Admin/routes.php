<?php

use Illuminate\Support\Facades\Route;

Route::group(
	[
		'prefix' 	=> 'admin',
		'middleware' => ['web'],
		'namespace'	=> 'Core\\Modules\\Admin\\Controllers'
	], function() {
        Route::get('dashboard', 'DashboardController@index');
    }
);