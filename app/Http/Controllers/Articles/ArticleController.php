<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;

use App\Http\Requests\ArticleRequest;

use App\Models\Articles\Article;



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Facades\App\Services\Users\UserService;
use Facades\App\Services\Files\ImageService;
use Facades\App\Services\Articles\ArticleService;
use Facades\App\Services\ShareService;

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
        Session::put('article_attachments', []);

        $groups = UserService::managedGroups(Auth::user());

        return view('articles.edit', compact(['articleObj', 'groups']));
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


        $articleObj = ArticleService::store($request->all(), Auth::user());

        $images = Session::get('article_images', []);
        foreach($images as $image){
            $imageObj = ImageService::findOrFail($image);
            $imageObj->object_id = $articleObj->id;
            $imageObj->object_type = 'article';
            $imageObj->save();
        }

        $attachments = Session::get('article_attachments', []);
        foreach($attachments as $attachment){

        }

        ShareService::setSharing($articleObj, $request->input('share'));

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

        $content = ArticleService::content($articleObj);
        $comments = ArticleService::comments($articleObj);

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

        $groups = UserService::managedGroups(Auth::user());

        return view('articles.edit',compact(['articleObj', 'groups']));
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

        ShareService::setSharing($articleObj, $request->input('share'));

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
