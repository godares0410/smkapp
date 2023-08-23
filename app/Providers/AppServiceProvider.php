<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Tambahasn
        Blade::directive('yieldUppercase', function ($expression) {
            return "<?php echo strtoupper(\$__env->yieldContent($expression)); ?>";
        });
        
        Blade::directive('yieldCapitalise', function ($expression) {
            return "<?php echo ucwords(\$__env->yieldContent($expression)); ?>";
        });

        Blade::directive('yieldLowercase', function ($expression) {
            return "<?php echo strtolower(\$__env->yieldContent($expression)); ?>";
        });
        
        
    }
}
