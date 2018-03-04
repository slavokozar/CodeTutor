<?php

namespace App\Http\Middleware;

use App\Models\Assignment;
use Closure;
use Illuminate\Support\Facades\Auth;

class AssignmentAuthorMiddleware
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
        $assignmentObj = Assignment::where('code', $request->assignment)->first();

        if($assignmentObj->group->isLecturer(Auth::user())){
            return $next($request);
        }else{
            return redirect(action('Assignments\AssignmentsController@show', $request->assignment));
        }
    }
}
