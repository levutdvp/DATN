<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

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
        //
        Paginator::useBootstrapFive();

        if (Schema::hasTable('settings')) {
            $setting = Setting::query()->first();
            view()->share('global_setting', $setting);
        } else {
            view()->share('global_setting', null);
        }
        if (Schema::hasTable('advertisements')) {
            $sidebar_top_ad = Advertisement::query()->where('location', 'top')->where('status', 'active')->get();
            $sidebar_bottom_ad = Advertisement::query()->where('location', 'bottom')->where('status', 'active')->get();

            view()->share('global_sidebar_top_ad', $sidebar_top_ad);
            view()->share('global_sidebar_bottom_ad', $sidebar_bottom_ad);
        } else {
            view()->share('global_sidebar_bottom_ad', null);
            view()->share('global_sidebar_top_ad', null);
        }

        Validator::extend('max_images', function ($attribute, $value, $parameters, $validator) {
            $maxImages = $parameters[0] ?? 4;
            if (is_array($value)) {
                return count($value) <= $maxImages;
            }

            return false;
        });
    }
}
