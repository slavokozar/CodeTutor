<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 17.4.2018
 * Time: 15:18
 */

namespace App\Http\Controllers\Profile;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Auth::user()->links()->paginate(config('app.table_pagination'));

        return view('profile.links.index', compact(['links']));
    }
}