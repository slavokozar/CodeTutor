<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 14.9.18
 * Time: 0:00
 */

namespace App\Http\Middleware\Users;


use Closure;
use Facades\App\Services\Users\Groups\GroupService;
use Illuminate\Support\Facades\Auth;

class GroupsViewMiddleware
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
        $group = $request->route('group');
        $groupObj = GroupService::get($group);

        if($groupObj === null){
            flash('Group `' .$group. '` does not exist')->error();
            return redirect(action('Users\Groups\GroupController@index'));
        }

        if(Auth::user()->can('update', $groupObj)){
            return $next($request);
        }

        return redirect(action('Users\Groups\GroupController@index'));
    }
}