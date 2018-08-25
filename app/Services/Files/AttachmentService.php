<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 4.4.2018
 * Time: 23:59
 */

namespace App\Services\Files;

use App\Models\Files\Attachment;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Intervention\Attachment\Facades\Attachment as AttachmentFacade;

class AttachmentService
{

    public function all(){

        //todo scope

        return Attachment::all();
    }

    public function paginate(){
        return Attachment::paginate(10);
    }

    public function getOrFail($code)
    {
        $imageObj = $this->get($code);

        if ($imageObj == null) {
            $this->fail($code);
        } else {
            return $imageObj;
        }
    }

    private function get($code)
    {
        return Attachment::where('code', $code)->first();
    }

    public function findOrFail($id)
    {
        $imageObj = Attachment::find($id);

        if ($imageObj == null) {
            $this->fail($id);
        } else {
            return $imageObj;
        }
    }

    private function fail($code)
    {
        Response::make('Attachment ' . $code . 'not found!', 404)->throwResponse();
    }



    public function getTargetPath()
    {
        return public_path('static-images');
    }


    public function getFile( $fileName )
    {
        return File::get($this->getTargetPath() . '/' . $fileName);
    }


    public function getFileSize( $fileName )
    {
        return File::size($this->getTargetPath() . '/' . $fileName);
    }

}