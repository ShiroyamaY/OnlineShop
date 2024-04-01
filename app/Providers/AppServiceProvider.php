<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connection;

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
        $this->configureRateLimiting();
        Model::preventLazyLoading(!$this->app->isProduction());
        Model::preventSilentlyDiscardingAttributes(!app()->isProduction());

        DB::whenQueryingForLongerThan(500,function (Connection $connection){
           // implement logging
        });

    }
    public function configureRateLimiting(): void
    {
        RateLimiter::for('global',function(Request $request){
            return Limit::perMinute(500)
                ->by($request->user()?->id ?: $request->ip())
                ->response(function(Request $request, array $headers){
                    return response("Take it easy",Response::HTTP_TOO_MANY_REQUESTS,$headers);
                });
        });
    }
}
