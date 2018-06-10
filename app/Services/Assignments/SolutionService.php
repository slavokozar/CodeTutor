<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 20/09/2017
 * Time: 01:34
 */

namespace App\Services\Assignments;


use App\Models\Assignments\Solution;
use Illuminate\Support\Facades\File;

class SolutionService
{

    public function last($assignmentObj, $userObj){
        $solutionObj = $assignmentObj->solutions()
            ->where('user_id', $userObj->id)
            ->orderBy('created_at', 'desc')
            ->first();

        return $solutionObj;
    }

    public function store($data){
        $articleObj = Solution::create([
            'user_id' => $data['user_id'],
            'code' => $data['code'],
            'assignment_id' => $data['assignment_id'],
            'lang_id' => $data['lang_id'],
            'filename' => $data['filename']
        ]);

        return $articleObj;
    }

//    public function get($userObj, $assignmentObj){
//        return $assignmentObj->solutions()->where('user_id', $userObj->id)->get();
//    }
//
//    public function currentHasResultFile($userObj, $assignmentObj){
//        $assignmentPath = env('UPLOAD_ASSIGNMENT') . '/' . $assignmentObj->code . '/users/' . $userObj->code;
//        return File::exists($assignmentPath . '/' . env('RESULTS_FILE'));
//    }
//
//    public function hasResultFile($userObj, $solutionObj){
//        //todo doplnit
//    }
//
//
//    public function currentFiles($userObj, $assignmentObj){
//        $assignmentPath = env('UPLOAD_ASSIGNMENT') . '/' . $assignmentObj->code . '/users/' . $userObj->code;
//        return $this->filesList($assignmentPath);
//    }
//
//    public function files($userObj, $solutionObj){
//        //todo doplnit
//    }
//
//    private function filesList($dir)
//    {
//        if (!File::exists($dir)) {
//            return "";
//        }
//
//        $result = '<ul>';
//
//        $directories = File::directories($dir);
//        foreach ($directories as $directory) {
//            $dirname = str_replace($dir . '/', '', (string)$directory);
//            if (!preg_match("|^__.*|", $dirname)) {
//                $result .= '<li><i class="fa fa-folder-open-o" aria-hidden="true"></i>&nbsp;' . $dirname;
//                $result .= $this->filesList((string)$directory);
//                $result .= '</li>';
//            }
//        }
//
//        $files = File::files($dir);
//        foreach ($files as $file) {
//            $file = str_replace($dir . '/', '', (string)$file);
//            if (!preg_match("|^__.*|", $file)) {
//                if (!preg_match('/' . $this->hiddenFilesRegex . '/', $file)) {
//                    $result .= '<li><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;' . $file . '</li>';
//                }
//            }
//        }
//
//        $result .= '</ul>';
//        return $result;
//    }
}