<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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
        Model::shouldBeStrict(!$this->app->isProduction());
        if (!$this->app->isProduction()){
            DB::listen(function($query){
                if ($query->time > 100){
                    Log::channel('telegram')
                        ->debug('query longer than 1ms:' . $query->sql,$query->bindings);
                }
            });

            app(Kernel::class)->whenRequestLifecycleIsLongerThan(
                CarbonInterval::seconds(4),
                function(){
                    Log::channel('telegram')
                        ->debug('whenRequestLifecycleIsLongerThen: ' . request()->url());
                }
            );
        }
    }
    public function configureRateLimiting(): void
    {
        RateLimiter::for('global',function(Request $request){
            return Limit::perMinute(500)
                ->by($request->user()?->id ?: $request->ip())
                ->response(function(Request $request, array $headers){
                    return response("Take it easy", ResponseAlias::HTTP_TOO_MANY_REQUESTS,$headers);
                });
        });
    }
}
