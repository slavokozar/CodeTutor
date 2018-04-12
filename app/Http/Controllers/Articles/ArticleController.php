<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;

use App\Http\Requests\ArticleRequest;

use App\Models\Articles\Article;
use App\Models\Image;
use Facades\App\Services\Articles\ArticleService;
use Facades\App\Services\Articles\TagService;

use Facades\App\Services\Users\GroupService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        $article = Article::first();
//
//        for($i = 0; $i < 5; $i++){
//            Image::create([
//                'object_id' => $article->id,
//                'object_type' => 'article',
//                'name' => uniqid(),
//                'ext' => 'jpg'
//            ]);
//        }
//
//

        $articles = ArticleService::paginate();

        return view('articles.index', compact(['articles']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articleObj = ArticleService::blank();

        Session::put('article_images', []);
        Session::put('article_files', []);

        return view('articles.edit', compact(['articleObj']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $articleObj = ArticleService::store($request->input(), Auth::user());

        return redirect(action('Articles\ArticleController@show', [$articleObj->code]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($article)
    {
        $articleObj = ArticleService::getOrFail($article);

//        $content = ArticleService::content($articleObj);
//        $comments = ArticleService::comments($articleObj);

        return view('articles.show',compact(['articleObj','content','comments']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($article)
    {
        $articleObj = ArticleService::getOrFail($article);

        return view('articles.edit',compact(['articleObj']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $article)
    {
        $articleObj = ArticleService::getOrFail($article);

        $articleObj = ArticleService::update($articleObj, $request->input());

        return redirect(action('Articles\ArticleController@show',[$articleObj->code]));
    }

    public function deleteModal($article)
    {
        $articleObj = ArticleService::getOrFail($article);

        return view('articles.delete',compact(['articleObj']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($article)
    {
        $articleObj = ArticleService::getOrFail($article);

        ArticleService::destroy($articleObj);

        return redirect(action('Articles\ArticleController@index'));
    }
}
