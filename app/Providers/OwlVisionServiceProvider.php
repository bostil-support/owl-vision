<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Setting;
use App\Models\Wish;
use App\Services\Basketlist;
use App\Services\Compare;
use App\Services\Comparelist;
use App\Services\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class OwlVisionServiceProvider extends ServiceProvider
{
    const DEFAULT_BASKETLIST_CACHE_KEY = 'ecommerce_basketlist';

    const DEFAULT_COMPARELIST_CACHE_KEY = 'ecommerce_comparelist';

    const DEFAULT_WISHLIST_CACHE_KEY = 'ecommerce_wishlist';
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            Basketlist::class,
            function () {
                foreach (config('ecommerce.basketlist.guards') as $item) {
                    if (Auth::guard($item)->check()) {
                        $guard = Auth::guard($item) ?? null;
                    }
                }
                return new Basketlist(
                    $guard ?? null,
                    new Cart,
                    config('ecommerce.basketlist.cacheKey') ?? self::DEFAULT_BASKETLIST_CACHE_KEY
                );
            }
        );

        $this->app->singleton(
            Comparelist::class,
            function () {
                foreach (config('ecommerce.comparelist.guards') as $item) {
                    if (Auth::guard($item)->check()) {
                        $guard = Auth::guard($item) ?? null;
                    }
                }
                return new Comparelist(
                    $guard ?? null,
                    new \App\Models\Compare(),
                    config('ecommerce.comparelist.cacheKey') ?? self::DEFAULT_COMPARELIST_CACHE_KEY
                );
            }
        );

        $this->app->singleton(
            Wishlist::class,
            function () {
                foreach (config('ecommerce.wishlist.guards') as $item) {
                    if (Auth::guard($item)->check()) {
                        $guard = Auth::guard($item) ?? null;
                    }
                }
                return new Wishlist(
                    $guard ?? null,
                    new Wish,
                    config('ecommerce.wishlist.cacheKey') ?? self::DEFAULT_WISHLIST_CACHE_KEY
                );
            }
        );
    }

    public function provides()
    {
        return [Basketlist::class, Comparelist::class, Wishlist::class];
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($theme = optional(Setting::query()->where('key', 'theme')->first('value'))->value) {
            config(
                [
                    'view.paths' => array_merge(
                        [
                            resource_path(
                                sprintf('themes/%s', $theme)
                            )
                        ],
                        config('view.paths')
                    )
                ]
            );
        }
    }
}
