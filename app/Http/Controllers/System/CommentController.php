<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Facades\App\Services\CommentService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
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
    public function index($objectType, $code)
    {
        $objectObj = CommentService::object($objectType, $code);

        return view('comments.index',compact(['objectObj']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($objectType, $code, $replyTo = null)
    {
        $objectObj = CommentService::object($objectType, $code);
        $commentObj = CommentService::findOrFail($replyTo);

        return view('comments.reply', compact(['objectObj','commentObj']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $objectType, $code, $replyTo = null)
    {
        $objectObj = CommentService::object($objectType, $code);
        $replyToObj = CommentService::findOrFail($replyTo);
        $commentObj = CommentService::create($objectObj, $replyToObj, $request->input());

        if($request->ajax()){
            return view('comments.show', compact(['objectObj','commentObj']));
        }

        return Redirect::back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($objectType, $code, $id)
    {
        $objectObj = CommentService::object($objectType, $code);
        $commentObj = CommentService::findOrFail($id);

        if($commentObj->object_id != $objectObj->id){
            abort(400, 'Bad action.');
        }

        if(!$commentObj->canModify(Auth::user())){
            abort(403, 'Unauthorized action.');
        }

        return view('comments.edit', compact(['objectObj','commentObj']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $objectType, $code, $id)
    {
        $objectObj = CommentService::object($objectType, $code);
        $commentObj = CommentService::findOrFail($id);

        if($commentObj->object_id != $objectObj->id){
            abort(400, 'Bad action.');
        }

        if(!$commentObj->canModify(Auth::user())){
            abort(403, 'Unauthorized action.');
        }

        $commentObj = CommentService::update($commentObj, $request->input());

        if($request->ajax()){
            return view('comments.show', compact(['objectObj','commentObj']));
        }

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $objectType, $code, $id)
    {
        $objectObj = CommentService::object($objectType, $code);
        $commentObj = CommentService::findOrFail($id);

        if($commentObj->object_id != $objectObj->id){
            abort(400, 'Bad action.');
        }

        if(!$commentObj->canModify(Auth::user())){
            abort(403, 'Unauthorized action.');
        }

        CommentService::delete($commentObj);
    }
}
