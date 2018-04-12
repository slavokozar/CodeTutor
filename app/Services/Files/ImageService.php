<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 4.4.2018
 * Time: 23:59
 */

namespace App\Services\Files;


use App\Models\Files\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image as ImageFacade;

class ImageService
{

    public function all(){

        //todo scope

        return Image::all();
    }

    public function paginate(){
        return Image::paginate(10);
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
        return Image::where('code', $code)->first();
    }

    public function findOrFail($id)
    {
        $imageObj = Image::find($id);

        if ($imageObj == null) {
            $this->fail($id);
        } else {
            return $imageObj;
        }
    }

    private function fail($code)
    {
        Response::make('Image ' . $code . 'not found!', 404)->throwResponse();
    }



    public function getTargetPath()
    {
        return public_path('static-images');
    }

    public function getDimensions( $fileName )
    {
        $image = ImageFacade::make(File::get($this->getTargetPath() . '/' . $fileName));

        $height = $image->height();
        $width = $image->width();

        return [$width, $height];
    }

    public function getFile( $fileName )
    {
        return File::get($this->getTargetPath() . '/' . $fileName);
    }


    public function getFileSize( $fileName )
    {
        return File::size($this->getTargetPath() . '/' . $fileName);
    }


    public function createThumbs( $originalFileName)
    {
        list($originalFileWidth, $originalFileHeight) = $this->getDimensions($originalFileName);
        $thumbs = ['thumbs' => []];
        $sizes = [
            [
                'width'  => 150,
                'height' => 150,
            ],
            [
                'width'  => 320,
                'height' => 320,
            ],
            [
                'width'  => 480,
                'height' => 480,
            ],
            [
                'width'  => 800,
                'height' => 800,
            ],

        ];



        $thumbs = ['thumbs' => []];

        $name = pathinfo($originalFileName, PATHINFO_FILENAME);
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

        foreach ($sizes as $size) {
            if ($originalFileWidth > $size['width']) {


                $adjustedHeight = number_format($size['width'] * $originalFileHeight / $originalFileWidth, 0, '.', '');

                $generatedImageName = $name . '-' . $size['width'] . 'x' . $adjustedHeight . '.' . $extension;

                $image = ImageFacade::make($this->getFile($originalFileName));
                $image = $image->resize($size['width'], $adjustedHeight);
                $image->save($this->getTargetPath() . '/' . $generatedImageName);


                $thumbs['thumbs'][] = [
                    'name'      => $name . '-' . $size['width'] . 'x' . $adjustedHeight,
                    'extension' => $extension,
                    'size'      => $this->getFileSize($generatedImageName),
                    'width'     => (int)$size['width'],
                    'height'    => (int)$adjustedHeight,
                ];
            }
        }

        return $thumbs;
    }


}