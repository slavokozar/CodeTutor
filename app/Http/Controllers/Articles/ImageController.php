<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 4.4.2018
 * Time: 21:28
 */

namespace App\Http\Controllers\Articles;


use App\Classes\MediaNameGenerator;
use App\Http\Controllers\Controller;


use App\Models\Files\Image;

use Facades\App\Services\Articles\ArticleService;
use Facades\App\Services\Files\ImageService;
use Facades\App\Services\Utils\CleanString;
use Facades\App\Services\Utils\UniqueCode;

use FileUpload\FileNameGenerator\Simple;
use FileUpload\FileUploadFactory;
use FileUpload\PathResolver;
use FileUpload\FileSystem;
use FileUpload\Validator\SizeValidator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ImageController extends Controller
{

    public function index($article){

        if($article == 'null'){
            $articleObj = null;
            $images = [];
            foreach(Session::get('article_images', []) as $image){
                $images[] = ImageService::findOrFail($image);
            }
        }else{
            $articleObj = ArticleService::getOrFail($article);
            $images = $articleObj->images;
        }



        return view('articles.images', compact(['articleObj', 'images']));
    }


    public function store($article = 'null', Request $request )
    {
        if($article == 'null'){
            $articleObj = null;
        }else{
            $articleObj = ArticleService::getOrFail($article);
        }

        try {
            $fileObj = null;

            $factory = new FileUploadFactory(new PathResolver\Simple(ImageService::getTargetPath()),
                new FileSystem\Simple(), [
                    new SizeValidator("100000"),
                ]
            );

            $fileupload = $factory->create($_FILES['files'], $_SERVER);

            // generate unique file names based on original file name
            $filenamegenerator = new Simple();
            $fileupload->setFileNameGenerator($filenamegenerator);

            // Doing the deed
            list($files, $headers) = $fileupload->processAll();

            // Outputting it, for example like this
            foreach ($headers as $header => $value) {
                header($header . ': ' . $value);
            }

            return 'ferko';

            if ($files[0]->completed) {
                $pathinfo = pathinfo($files[0]->name);

                $normalized = CleanString::normalize($pathinfo['filename']);
                $code = UniqueCode::unique(Image::class, $normalized);

                $filename = $code . '.' . $pathinfo['extension'];

                File::move(ImageService::getTargetPath() . '/' . $files[0]->name, ImageService::getTargetPath() . '/' . $filename);

//                ImageService::createThumbs($filename);

                $imageObj = Image::create([
                    'code' => $code,
                    'name' => $pathinfo['filename'],
                    'ext' => $pathinfo['extension']
                ]);

                if($articleObj != null){
                    $imageObj->object_id = $articleObj->id;
                    $imageObj->object_type = 'article';
                    $imageObj->save();
                }else{
                    $request->session()->push('article_images', $imageObj->id);
                }

                return $imageObj;

            } else {
                return json_encode(['files' => $files]);
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}