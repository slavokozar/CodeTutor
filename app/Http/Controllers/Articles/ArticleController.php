<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;

use App\Http\Requests\ArticleRequest;

use Facades\App\Services\Articles\ArticleService;
use Facades\App\Services\Articles\TagService;

use Facades\App\Services\Users\GroupService;


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
        $articles = ArticleService::all();
        $tags = TagService::all();

        return view('articles.index', compact(['articles', 'tags']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = GroupService::all();

        return view('articles.create', compact(['groups']));
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
        $articleObj = ArticleService::store($request->input());

        return redirect(action('Articles\ArticleController@show', [$articleObj->code]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $articleObj = ArticleService::getOrFail($code);

        $content = ArticleService::content($articleObj);
        $comments = ArticleService::comments($articleObj);

        return view('articles.show',compact(['articleObj','contentObj','comments']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($code)
    {
        $articleObj = ArticleService::getOrFail($code);
        $groups = GroupService::all();

        return view('articles.edit',compact(['articleObj','groups']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $code)
    {
        $articleObj = ArticleService::getOrFail($code);

        $articleObj = ArticleService::update($articleObj, $request->input());

        return redirect(action('Articles\ArticleController@show',[$articleObj->code]));
    }

    public function delete($code)
    {
        $articleObj = ArticleService::getOrFail($code);

        return view('articles.delete',compact(['articleObj']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        $articleObj = ArticleService::getOrFail($code);
        ArticleService::delete($articleObj);

        return redirect(action('Articles\ArticleController@index'));
    }
}
