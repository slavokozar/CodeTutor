<?php

namespace App\Http\Controllers\Assignments;


use App\Http\Controllers\Controller;
use App\Models\Assignments\Solution;
use App\Models\Assignments\SolutionComment;
use Facades\App\Services\Assignments\AssignmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class SolutionController extends Controller
{



    public function index($assignment)
    {
        $assignmentObj = AssignmentService::getOrFail($assignment);

        //todo viac sql solution
        $solutions = $assignmentObj->solutions()->orderBy('created_at','desc')->get()->unique('user_id');

        return view('assignments.solutions.index', compact(['assignmentObj', 'solutions']));
    }



    public function show($assignment, $solution){

        $assignmentObj = AssignmentService::getOrFail($assignment);
        $solutionObj = $assignmentObj->solutions()->where('code', $solution)->firstOrFail();

        $files = $solutionObj->files;

        return view('assignments.solutions.show', compact(['assignmentObj', 'solutionObj', 'files']));
    }


    public function update($assignment, $solution, Request $request){

        $assignmentObj = AssignmentService::getOrFail($assignment);
        $solutionObj = $assignmentObj->solutions()->where('code', $solution)->firstOrFail();

        $solutionObj->review = $request->input('review');
        $solutionObj->review_points = $request->input('review_points');
        $solutionObj->save();

        return redirect(action('Assignments\SolutionController@index', [$assignmentObj->code]));
    }

    public function source($assignment, $solution, $file){
        $assignmentObj = AssignmentService::getOrFail($assignment);
        $solutionObj = $assignmentObj->solutions()->where('code', $solution)->firstOrFail();
        $fileObj = $solutionObj->files()->where('code', $file)->firstOrFail();

        $comments = [];
        foreach($fileObj->comments as $commentObj){
            $comments[$commentObj->line] = $commentObj->text;
        }

        if($assignmentObj->solutions()->where('user_id', Auth::user()->id)->where('created_at','>',$solutionObj->created_at)->count() > 0){
            $path = AssignmentService::pathArchive($assignmentObj, $solutionObj->user);
        }else{
            $path = AssignmentService::pathSolution($assignmentObj, $solutionObj->user);
        }
        //taham aktivne solution, alebo riesenie z archivu?

//        return $fileObj;
        $filepath = $path . $fileObj->dirname . ($fileObj->dirname != '/' ? '/' : '' )  . $fileObj->filename . '.' . $fileObj->ext;

        $content = File::get($filepath);

        return view('assignments.solutions.source', compact(['assignmentObj', 'solutionObj', 'fileObj', 'content', 'comments']));
    }

    public function comments($assignment, $solution, $file, Request $request){
        $assignmentObj = AssignmentService::getOrFail($assignment);
        $solutionObj = $assignmentObj->solutions()->where('code', $solution)->firstOrFail();
        $fileObj = $solutionObj->files()->where('code', $file)->firstOrFail();


        $comments = json_decode($request->get('comments'));

        $fileObj->comments()->whereNotIn('line', array_keys(get_object_vars($comments)))->delete();

        foreach($comments as $line => $text){
            $commentObj = $fileObj->comments()->where('line', $line)->first();
            if($commentObj != null){
                $commentObj->text = $text;
                $commentObj->save();
            }else{
                SolutionComment::create([
                    'file_id' => $fileObj->id,
                    'line' => $line,
                    'text' => $text
                ]);
            }
        }

        return redirect(action('Assignments\SolutionController@show', [$assignmentObj->code, $solutionObj->code]));
    }
}
