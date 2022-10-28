<?php

use Illuminate\Support\Facades\Route;

Route::group(
	[
		'middleware' => ['web'],
		'namespace'	=> 'Core\\Modules\\Web\\Controllers'
	], function() {
    }
);