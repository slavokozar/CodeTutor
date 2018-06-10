<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 20/09/2017
 * Time: 01:34
 */

namespace App\Services\Assignments;


use App\Models\Assignments\ProgrammingLanguage;
use Illuminate\Support\Facades\File;

class SubmitService
{

    public function getTargetPath()
    {
        return storage_path('static-images');
    }


    public function getLangObj($path){

        $code = $this->getLangCode($path);

        if($code == '') return null;

        return ProgrammingLanguage::where('code', $code)->first();

    }

    public function getLangCode($path)
    {
        $lang = '';

        $files = File::files($path);
        foreach ($files as $file) {
            $filename = pathinfo($file)['basename'];
            if($filename == 'Main.java'){

                File::makeDirectory($path . '/Main');
                File::move($file, $path . '/Main/' . $filename );

                return 'java';
            }else{
                $ext = pathinfo($file)['extension'];
                if($ext == 'c'){
                    return 'c';
                }elseif($ext == 'cpp'){
                    return 'c++';
                }
            }
        }

        $directories = File::directories($path);
        foreach ($directories as $directory) {
            $dirname = str_replace($path . '/', '', (string)$directory);

            $files = File::files($directory);
            foreach ($files as $file) {
                $filename = pathinfo($file)['basename'];
                if ($dirname == 'Main' && $filename == 'Main.java') {
                    return 'java';
                }
            }
        }

        return $lang;
    }


    public function files($userObj, $assignmentObj)
    {
        $assignmentPath = env('UPLOAD_ASSIGNMENT') . '/' . $assignmentObj->code . '/users/' . $userObj->code;
        return $this->filesList($assignmentPath);
    }

    private function filesList($dir)
    {
        if (!File::exists($dir)) {
            return "";
        }

        $result = '<ul>';

        $directories = File::directories($dir);
        foreach ($directories as $directory) {
            $dirname = str_replace($dir . '/', '', (string)$directory);
            if (!preg_match("|^__.*|", $dirname)) {
                $result .= '<li><i class="fa fa-folder-open-o" aria-hidden="true"></i>&nbsp;' . $dirname;
                $result .= $this->filesList((string)$directory);
                $result .= '</li>';
            }
        }

        $files = File::files($dir);
        foreach ($files as $file) {
            $file = str_replace($dir . '/', '', (string)$file);
            if (!preg_match("|^__.*|", $file)) {
                if (!preg_match('/' . $this->hiddenFilesRegex . '/', $file)) {
                    $result .= '<li><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;' . $file . '</li>';
                }
            }
        }

        $result .= '</ul>';
        return $result;
    }

}