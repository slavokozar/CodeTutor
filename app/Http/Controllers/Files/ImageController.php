<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 5.4.2018
 * Time: 22:29
 */

namespace App\Http\Controllers\Files;


use App\Http\Controllers\Controller;
use Facades\App\Services\Files\ImageService;

class ImageController extends Controller
{

    public function modalThumb($image){

        $imageObj = ImageService::getOrFail($image);

        return view('files.images.modal-thumb', compact(['imageObj']));
    }
}