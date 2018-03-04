<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 31/12/2016
 * Time: 01:33
 */

namespace App\_Classes;


use App\Facades\RequestServiceFacade;

class TesterService
{

    public function start($solution_id){
        if(env('TESTER_ENABLE')){
            $data = (object)['solution_id'=>$solution_id];
            $response =  RequestServiceFacade::sendRequest('POST', env('TESTER_URL').'/start', $data);
            return $response;
        }else{
            return false;
        }

    }



    public function status($task_id){
        if(env('TESTER_ENABLE')){

            if($task_id == ""){
                $data = (object)['task_id' => 'all'];
            }else{
                $data = (object)['task_id' => $task_id];
            }

            try {
                $response = RequestServiceFacade::sendRequest('POST', env('TESTER_URL').'/status', $data);
            } catch (Exception $e) {
                return false;
            }

            return $response;
        }else{
            return false;
        }
    }

    public function drop($task_id){
        if(env('TESTER_ENABLE')){

            if($task_id == ''){
                return false;
            }else{
                $data = (object)['task_id' => intval($task_id)];

                try {
                    $response = RequestServiceFacade::sendRequest('POST', env('TESTER_URL').'/drop', $data);
                } catch (Exception $e) {
                    return 'exception';
                }

                return $response;
            }

        }else{
            return false;
        }
    }

}