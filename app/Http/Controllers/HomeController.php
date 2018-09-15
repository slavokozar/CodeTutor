<?php

namespace App\Http\Controllers;

use App\Models\Sharing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $userObj = Auth::user();
        $groups = $userObj->groups;
        $schools = $userObj->schools;


        $activities = Sharing::whereIn('group_id', $groups->pluck('id'))->orWhereIn('school_id', $schools->pluck('id'))->paginate();



        return view('feed.index', compact(['userObj', 'groups', 'schools', 'activities']));
    }
}
