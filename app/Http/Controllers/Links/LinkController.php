<?php

namespace App\Http\Controllers\Links;

use App\Http\Controllers\Controller;

use App\Http\Requests\LinkRequest;

use Illuminate\Support\Facades\Auth;

use Facades\App\Services\Users\UserService;
use Facades\App\Services\Links\LinkService;
use Facades\App\Services\ShareService;


class LinkController extends Controller
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
        $links = LinkService::paginate();

        return view('links.index', compact(['links']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $linkObj = LinkService::blank();

        $groups = UserService::managedGroups(Auth::user());

        return view('links.edit', compact(['linkObj', 'groups']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LinkRequest $request)
    {
        $linkObj = LinkService::store($request->all(), Auth::user());

        ShareService::setSharing($linkObj, $request->input('share'));

        return redirect(action('Links\LinkController@show', [$linkObj->code]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($link)
    {
        $linkObj = LinkService::getOrFail($link);

        $comments = LinkService::comments($linkObj);

        return view('links.show',compact(['linkObj','content','comments']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($link)
    {
        $linkObj = LinkService::getOrFail($link);

        $groups = UserService::managedGroups(Auth::user());

        return view('links.edit',compact(['linkObj', 'groups']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(LinkRequest $request, $link)
    {
        $linkObj = LinkService::getOrFail($link);

        $linkObj = LinkService::update($linkObj, $request->input());

        ShareService::setSharing($linkObj, $request->input('share'));

        return redirect(action('Links\LinkController@show',[$linkObj->code]));
    }

    public function deleteModal($link)
    {
        $linkObj = LinkService::getOrFail($link);

        return view('links.delete',compact(['linkObj']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($link)
    {
        $linkObj = LinkService::getOrFail($link);

        LinkService::destroy($linkObj);

        return redirect(action('Links\LinkController@index'));
    }
}
