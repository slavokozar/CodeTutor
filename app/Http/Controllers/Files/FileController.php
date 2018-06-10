<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;

use App\Http\Requests\FileRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Facades\App\Services\Users\UserService;
use Facades\App\Services\Files\FileService;
use Facades\App\Services\ShareService;


class FileController extends Controller
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
        $files = FileService::paginate();

        return view('files.index', compact(['files']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fileObj = FileService::blank();
        $groups = UserService::managedGroups(Auth::user());

        return view('files.edit', compact(['fileObj', 'groups']));
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
        $fileObj = FileService::store($request->all(), Auth::user());

        $images = Session::get('file_images', []);
        foreach($images as $image){
            $imageObj = ImageService::findOrFail($image);
            $imageObj->object_id = $fileObj->id;
            $imageObj->object_type = 'file';
            $imageObj->save();
        }

        $attachments = Session::get('file_attachments', []);
        foreach($attachments as $attachment){

        }

        ShareService::setSharing($fileObj, $request->input('share'));

        return redirect(action('Files\FileController@show', [$fileObj->code]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($file)
    {
        $fileObj = FileService::getOrFail($file);
        
        return view('files.show',compact(['fileObj','content','comments']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($file)
    {
        $fileObj = FileService::getOrFail($file);

        $groups = UserService::managedGroups(Auth::user());

        return view('files.edit',compact(['fileObj', 'groups']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $file)
    {
        $fileObj = FileService::getOrFail($file);

        $fileObj = FileService::update($fileObj, $request->input());

        ShareService::setSharing($fileObj, $request->input('share'));

        return redirect(action('Files\FileController@show',[$fileObj->code]));
    }

    public function deleteModal($file)
    {
        $fileObj = FileService::getOrFail($file);

        return view('files.delete',compact(['fileObj']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($file)
    {
        $fileObj = FileService::getOrFail($file);

        FileService::destroy($fileObj);

        return redirect(action('Files\FileController@index'));
    }
}
