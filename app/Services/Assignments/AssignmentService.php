<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 29.09.16
 * Time: 23:22
 */

namespace App\Services\Assignments;

use App\_Classes\Parsedown;
use App\Models\Assignments\Assignment;
use App\Models\User;
use Facades\App\Services\Assignments\SolutionService as SolutionServiceFacade;
use Facades\App\Services\Utils\CleanString as CleanStringFacade;
use Facades\App\Services\Utils\UniqueCode as UniqueCodeFacade;
use Illuminate\Support\Facades\Auth;

class AssignmentService
{
    public function all()
    {
        return Assignment::all();
    }

    public function paginate()
    {
        return Assignment::paginate(10);
    }

    public function get($code)
    {
        return Assignment::where('code', $code)->first();
    }

    public function getOrFail($code)
    {
        $assignmentObj = $this->get($code);

        if ($assignmentObj == null) {

        }
        return $assignmentObj;
    }

    public function findOrFail($id)
    {
        $articleObj = Assignment::find($id);

        if ($articleObj == null) {
            $this->fail($id);
        }
        return $articleObj;
    }

    private function fail($code)
    {
        Response::make('User ' . $code . 'not found!', 404)->throwResponse();
    }

    public function content($articleObj)
    {
        $parsedown = new Parsedown();

        return $parsedown->text($articleObj->text);
    }

    public function comments($articleObj)
    {
        return $articleObj->comments()->limit(5)->get();
    }

    public function blank()
    {
        return new Assignment();
    }


    public function store($data)
    {
        $normalized = CleanStringFacade::normalize($data['name']);

        $code = UniqueCodeFacade::unique(Assignment::class, $normalized);

//        File::makeDirectory(env('TEST_PATH') . '/' . $code);
//        File::makeDirectory(env('TEST_PATH') . '/' . $code . '/test');
//        File::makeDirectory(env('TEST_PATH') . '/' . $code . '/users');



        $assignmentObj = Assignment::create([
            'name' => $data['name'],
            'code' => $code,
            'author_id' => Auth::user()->id,

            'description' => (isset($data['no-description']) && $data['no-description']) ? substr(strip_tags($data['text']), 0, 160) : $data['description'],
            'text' => $data['text'],
            'tasks' => $data['tasks'],

            'start_at' => date('Y-m-d H:i:s', strtotime(str_replace('. ','-', $data['start']))),
            'deadline_at' => date('Y-m-d H:i:s', strtotime(str_replace('. ','-', $data['deadline']))),
        ]);

        $assignmentObj->programmingLanguages()->attach($data['languages']);

        return $assignmentObj;
    }

    public function update($assignmentObj, $data)
    {
        if ($data['name'] != $assignmentObj->name) {
            $normalized = CleanStringFacade::normalize($data['name']);

            $code = UniqueCodeFacade::unique(Assignment::class, $normalized);

            $assignmentObj->name = $data['name'];
            $assignmentObj->code = $code;
        }

        $assignmentObj->description = $data['description'];
        $assignmentObj->text = $data['text'];

        $assignmentObj->tasks = $data['tasks'];

        $assignmentObj->start_at = date('Y-m-d H:i:s', strtotime(str_replace('. ','-', $data['start'])));
        $assignmentObj->deadline_at = date('Y-m-d H:i:s', strtotime(str_replace('. ','-', $data['deadline'])));

        $assignmentObj->save();

        $assignmentObj->programmingLanguages()->sync($data['languages']);

        return $assignmentObj;
    }

    public function delete($assignmentObj)
    {
        $assignmentObj->delete();

        return true;
    }


//    public function path($assignmentObj, $file = null){
//
//        return env('TEST_PATH') . '/' . $assignmentObj->code . '/test/' . $file;
//    }

    public function path($assignmentObj)
    {
        return storage_path('assignments/' . $assignmentObj->code);
    }

    public function pathSolution($assignmentObj, $userObj)
    {
        return $this->path($assignmentObj) . '/solutions/' . $userObj->code;
    }

    public function pathArchive($assignmentObj, $userObj)
    {
        return $this->path($assignmentObj) . '/archive/' . $userObj->code;
    }


    public function deadline($assignmentObj)
    {

        $diff = abs(time() - strtotime($assignmentObj->deadline_at));


        $days = floor($diff / (60 * 60 * 24));
        $hours = floor(($diff - $days * 60 * 60 * 24) / (60 * 60));
        $minutes = floor(($diff - $days * 60 * 60 * 24 - $hours * 60 * 60) / (60));

        if ($days > 0) {
            return "<span>" . $days . "</span> dní <span>" . $hours . "</span> hodín";
        } else {
            return "<span>" . $hours . "</span> hodín <span>" . $minutes . "</span> minút";
        }

    }

    public function maxTestScore($assignmentObj)
    {
        return 20;
    }

    public function maxReviewScore($assignmentObj)
    {
        return 80;
    }

    public function userSolutions($assignmentObj, $userObj)
    {
        return $assignmentObj->solutions()->where('user_id', $userObj->id)->count();
    }

    public function userTestScore($assignmentObj, $userObj)
    {
        $solutionObj = SolutionServiceFacade::last($assignmentObj, $userObj);
        if ($solutionObj == null) {
            return 0;
        } else {
            return $solutionObj->scores()->sum('points');
        }
    }

    public function userHasReview($assignmentObj, $userObj)
    {
        $solutionObj = SolutionServiceFacade::last($assignmentObj, $userObj);
        if ($solutionObj == null) {
            return 0;
        } else {
            return $solutionObj->reviews()->count() > 0;
        }
    }

    public function userReviewScore($assignmentObj, $userObj)
    {
        $solutionObj = SolutionServiceFacade::last($assignmentObj, $userObj);
        if ($solutionObj == null) {
            return 0;
        } else {
            return $solutionObj->review_points;
        }
    }
}