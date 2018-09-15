<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 14.9.18
 * Time: 0:00
 */

namespace App\Http\Middleware\Users;


use Closure;

class UsersMiddleware
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
        if(Gate::allows('users-view')){
            return $next($request);
        }

        return action('HomeController@index');
    }
}