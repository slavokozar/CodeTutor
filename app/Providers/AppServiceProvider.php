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
            return $userObj->isAdmin() ||
                $userObj->groups()->wherePivot('role', GroupRoles::TEACHER)->count() > 0 ||
                $userObj->schools()->wherePivotIn('role', [SchoolRoles::ADMIN, SchoolRoles::TEACHER])->count() > 0;
        });

        Gate::define('schools-view', function ($userObj) {
            return $userObj->isAdmin() ||
                $userObj->schools()->wherePivotIn('role', [SchoolRoles::ADMIN, SchoolRoles::TEACHER])->count() > 0;
        });

        Gate::define('groups-view', function ($userObj) {
            return $userObj->isAdmin() ||
                Gate::allows('schools-view') ||
                $userObj->groups()->wherePivot('role', SchoolRoles::TEACHER)->count() > 0;
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
