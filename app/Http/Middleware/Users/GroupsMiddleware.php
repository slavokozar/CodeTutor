<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 14.9.18
 * Time: 0:00
 */

namespace App\Http\Middleware\Users;


use Closure;
use Illuminate\Support\Facades\Gate;

class GroupsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Gate::allows('groups-view')){
            return $next($request);
        }

        return action('Users\UserController@index');
    }
}