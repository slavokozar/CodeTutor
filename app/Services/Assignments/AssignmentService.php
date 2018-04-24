<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 29.09.16
 * Time: 23:22
 */

namespace App\Services\Assignments;

use App\Models\User;
use App\Models\Assignment;

use App\_Classes\UUID;
use App\_Classes\Parsedown;

use Illuminate\Support\Facades\Auth;

use Facades\App\Services\Utils\CleanString;
use Illuminate\Support\Facades\File;

class AssignmentService
{

    public function all(){
        return Assignment::all();
    }

    public function get($code){
        return Assignment::where('code',$code)->first();
    }

    public function getOrFail($code){
        $assignmentObj = $this->get($code);

        if($assignmentObj == null){

        }
        return $assignmentObj;
    }


    public function content($articleObj){
        $parsedown = new Parsedown();

        return $parsedown->text($articleObj->text);
    }


    public function comments($articleObj){
        return $articleObj->comments()->limit(5)->get();
    }

    public function paginate($userObj, $page = 1){
        $limit = 10;


        if($userObj != null){
            return Assignment::whereHas('group',function($q) use ($userObj){
                $q->whereHas('users',function($q1) use ($userObj) {
                    $q1->where('users.id', $userObj->id);
                });
            })->skip($limit * $page)->take($limit)->get();
        }else{
            return Assignment::whereHas('group',function($q){
                $q->where('user_groups.is_public', 1);
            })->skip($limit * ($page - 1))->take($limit)->get();
        }


    }

    public function path($assignmentObj, $file = null){

        return env('TEST_PATH') . '/' . $assignmentObj->code . '/test/' . $file;
    }

    public function create($data){
        $normalized = CleanString::normalize($data['name']);

        do {
            $code = new UUID;
            $code = $code->limit(6, 4);
            $code = $normalized . '-' . $code;
        } while (count(Assignment::where('code', $code)->get()) > 0);

        File::makeDirectory(env('TEST_PATH') . '/' . $code);
        File::makeDirectory(env('TEST_PATH') . '/' . $code . '/test');
        File::makeDirectory(env('TEST_PATH') . '/' . $code . '/users');

        $assignmentObj = Assignment::create([
            'name' => $data['name'],
            'code' => $code,
            'is_public' => $data['is_public'] ? true : false,

            'group_id' => $data['group'],
            'author_id' => Auth::user()->id,
            'series_id' => null,
            'series_order' => null,

            'description' => $data['description'],
            'text' => $data['text'],

            'start_at' => date('Y-m-d H:i:s', strtotime($data['start'])),
            'deadline_at' => date('Y-m-d H:i:s', strtotime($data['deadline'])),
        ]);

        $assignmentObj->programmingLanguages()->attach($data['languages']);

        return $assignmentObj;

    }


    public function update($assignmentObj, $data){
        if ($data['name'] != $assignmentObj->name) {
            $normalized = CleanString::normalize($data['name']);
            do {
                $code = new UUID;
                $code = $code->limit(6, 4);
                $code = $normalized . '-' . $code;
            } while (count(Assignment::where('code', $code)->get()) > 0);

            $assignmentObj->name = $data['name'];
            $assignmentObj->code = $data['code'];
        }

        $assignmentObj->programmingLanguages()->sync($data['languages']);

        $assignmentObj->group_id = $data['group'];
        $assignmentObj->is_public = isset($data['is_public']) && $data['is_public'] ? true : false;


        $assignmentObj->description = $data['description'];
        $assignmentObj->text = $data['text'];

        $assignmentObj->start_at = $data['start'];
        $assignmentObj->deadline_at = $data['deadline'];

        $assignmentObj->programmingLanguages()->sync($data['languages']);

        $assignmentObj->save();

        return $assignmentObj;
    }



    public function delete($assignmentObj){
        $assignmentObj->delete();

        return true;
    }





    /*
     *
     *
    public function userScore()
    {
        if($this->userSolution() == null) return 0;
        return $this->userSolution()->scores()->sum('points');
    }

    public function maxScore()
    {
        return 22;
    }

    public function userHasManualScore(){
        return true;
    }

    public function userManualScore()
    {
        return 10;
    }

    public function maxManualScore()
    {
        return 10;
    }

    public function userReview()
    {
        if($this->userSolution() == null) return 0;
        return $this->userSolution()->reviews()->sum('points');
    }




    public function deadline()
    {
        $diff = abs(date("Y-m-d H:i:s") - strtotime($this->deadline_at));

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours =  floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 )/ (60*60));
        $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60)/ (60));

        if($days > 0){
            return "<span>" . $days . "</span> dní <span>" . $hours . "</span> hodín";
        }else{
            return "<span>" . $hours . "</span> hodín <span>" . $minutes . "</span> minút";
        }

    }
     *
     */

}