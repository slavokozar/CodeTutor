<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 4.4.2018
 * Time: 23:59
 */

namespace App\Services\Files;


use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageService
{

    public function getTargetPath()
    {
        return public_path('static-images');
    }

    public function getDimensions( $fileName )
    {
        $image = Image::make(File::get($this->getTargetPath() . '/' . $fileName));

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


    public function createThumbs( $originalFileName, $originalFileWidth, $originalFileHeight )
    {
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

                $image = Image::make($this->getFile($originalFileName));
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


    /**
     * @param $sourceName
     *
     * @return string
     */
    public function storeEncodedFile( $sourceName )
    {
        $encodedName = $this->getEncodedFileName($sourceName);
        File::move($this->getTargetPath() . '/' . $sourceName, $this->getTargetPath() . '/' . $encodedName);
        return $encodedName;
    }

    private function getEncodedFileName( $sourceName )
    {
        $uniqueCode = bin2hex(openssl_random_pseudo_bytes(10));
        $urlCode = urlencode($uniqueCode);

        return ( $this->getUniqueFilename($urlCode, pathinfo($sourceName, PATHINFO_EXTENSION)) );
    }

    private function getUniqueFilename( $name, $extension )
    {
        $index = 1;
        $actualName = ( $name . '.' . $extension );
        while (File::exists(config('media.target_path') . '/' . $actualName)) {
            $actualName = ( $name . $index . '.' . $extension );
            $index++;
        }

        return $actualName;
    }
}