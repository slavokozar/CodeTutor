<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 4.4.2018
 * Time: 21:29
 */

namespace App\Http\Controllers\Articles;


use App\Http\Controllers\Controller;

class AttachementController extends Controller
{
    public function index($article){
        return view('articles/images.blade.php');
    }
}