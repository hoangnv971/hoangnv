<?php

namespace Core\Modules;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    	$folders = scandir(__DIR__);

    	foreach ($folders as $folder) {
    		if (file_exists(__DIR__.'/'.$folder.'/routes.php')) {
    			include __DIR__.'/'.$folder.'/routes.php';
    		}
    		if (is_dir(__DIR__.'/'.$folder.'/Views/')) {
    			$this->loadViewsFrom(__DIR__.'/'.$folder.'/Views', $folder);
    		}
    		if (is_dir(__DIR__.'/'.$folder.'/Components/')) {
    			Blade::componentNamespace('Core\\Modules\\'.$folder.'\\Components', $folder);
    		}
        }

    }
}
