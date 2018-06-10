<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;

use App\Models\Article;
use App\Models\Assignment;

use Facades\App\Services\Articles\ArticleService;
use Illuminate\Database\Eloquent\Collection;

class PresentationController extends Controller
{
    public function index()
    {
////        $articles = Article::orderBy('created_at','DESC')->limit(5)->get();
////        $assignments = Assignment::orderBy('created_at','DESC')->limit(5)->get();
//        $carousel = $articles->merge($assignments)->sortByDesc('creted_at')->slice(0,5);

        return view('propagation.index');
    }

    public function rules()
    {
        $articleObj = Article::withPrivate()->where('code','rules_sk')->first();

        if($articleObj){
            $content = ArticleService::content($articleObj);
        }

        return view('propagation.rules',compact(['articleObj','content']));
    }

    public function wanted(){
        return view('propagation.wanted');
    }
}
