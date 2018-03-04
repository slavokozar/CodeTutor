<?php
/**
 * Created by PhpStorm.
 * User: Lukas Figura
 * Date: 02.10.16
 * Time: 11:00
 */

namespace App\_Classes;

use App\Models\AssignmentSolutionScore;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use Psr\Http\Message\ResponseInterface;

class ResultsService
{

    public function solution($user, $assignment){
        return $user->solutions()->where('assignment_id',$assignment->id)->get()->last();
    }

    public function taskPoints($user, $assignment, $task, $test){
        $solution = $this->solution($user, $assignment);
        if($solution == null) return null;

        $score = AssignmentSolutionScore::where('solution_id', $solution->id)->where('task',$task)->where('test',$test)->first();
        if($score != null){
            return $score->points;
        }else{
            return 0;
        }
    }

    public function assignmentPoints($user, $assignment){
        $solution = $this->solution($user, $assignment);
        if($solution == null) return null;

        return $solution->scores->sum('points');
    }




}