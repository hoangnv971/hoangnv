<?php

use Illuminate\Support\Facades\Route;

Route::group(
	[
		'prefix' 	=> 'admin',
		'middleware' => ['web', 'auth'],
		'namespace'	=> 'Core\\Modules\\Admin\\Controllers',
		'as' => 'admin.'
	], function() {
		Route::get('/', 'DashboardController@index')->name('home');
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::match(['get', 'post'],'users', 'UserController@index')->name('user.index');
    }
);