<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class OwlVisionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
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
