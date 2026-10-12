<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (isset($_SERVER['VERCEL']) || env('VERCEL') || env('APP_STORAGE')) {
            config([
                'cache.default' => 'array',
                'session.driver' => 'cookie',
            ]);
        }

        $this->app->extend('url', function ($url, $app) {
            $custom = new \App\Routing\UrlGenerator(
                $app['router']->getRoutes(),
                $url->getRequest(),
                $app['config']['app.asset_url']
            );
            $custom->setSessionResolver(fn() => $app['session'] ?? null);
            $custom->setKeyResolver(fn() => [$app['config']->get('app.key'), ...($app['config']->get('app.previous_keys') ?? [])]);
            return $custom;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (isset($_SERVER['VERCEL']) || env('VERCEL') || env('APP_STORAGE') || app()->isProduction() || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')) {
            URL::forceScheme('https');
        }
    }
}
