<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Setting;
use App\Models\Value;
use App\Models\Variation;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


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
    Schema::defaultStringLength(191);
    $_s = [];

    if (Schema::hasTable('settings')) {

        // 🟢 Directly get data from DB without cache
        $settings_Data = Setting::with('image')->orderBy('group_sorting')->get();

        $groups = [];
        $settings = [];

        foreach ($settings_Data as $key => $value) {
            $settings[$value->field] = $value->value;
            array_push($groups, $value->grouping);
        }

        $_s = $settings;
        $_s['grouping'] = implode(',', array_unique($groups));
    }

    if (Schema::hasTable('settings')) {
        // 🟢 Again, no cache
        $_s['menus'] = Menu::with('children.children.children')->get();
    }

    View::share('_s', $_s);
}

}