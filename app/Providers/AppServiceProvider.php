<?php

namespace App\Providers;

use App\Classes\GroupRoles;
use App\Classes\SchoolRoles;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $action = app('request')->route()->getAction();
            if(array_key_exists ('controller', $action)){
                $controller = class_basename($action['controller']);
                list($controller, $action) = explode('@', $controller);
                $view->with(compact('_controller', '_action'));
            }
        });

        Gate::define('users-view', function ($userObj) {


            return $userObj->groups()->wherePivot('role', GroupRoles::teacher)->count() > 0 ||
                $userObj->schools()->wherePivotIn('role', [SchoolRoles::admin, SchoolRoles::teacher])->count() > 0;

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
