<?php

namespace App\Providers;

use App\Models\Variable;
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
        foreach (Variable::all() as $var) :
            $vars[$var->name] = $var->description;
        endforeach;
        View::share('web_var', $vars);
    }
}
