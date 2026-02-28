<?php
namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Performance: Prevent lazy loading in development to catch N+1 queries
        Model::preventLazyLoading(! app()->isProduction());

        // Performance: Use Tailwind pagination views
        Paginator::useTailwind();
    }
}
