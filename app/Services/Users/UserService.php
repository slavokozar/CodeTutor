<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 17/09/2017
 * Time: 19:54
 */

namespace App\Services\Users;

use App\Models\Users\User;
use Illuminate\Support\Facades\Response;

class UserService
{
    public function all(){

        //todo scope

        return User::all();
    }

    public function getOrFail($code)
    {
        $userObj = $this->get($code);

        if ($userObj == null) {
            $this->fail($code);
        } else {
            return $userObj;
        }
    }

    private function get($code)
    {
        return User::where('code', $code)->first();
    }

    private function fail($code)
    {
        Response::make('User ' . $code . 'not found!', 404);
    }


    public function blank(){
        return new User();
    }


    public function create($data){
        $data['code'] = uniqid();
        $userObj = User::create($data);

        return $userObj;
    }




    public function update($userObj, $data){
        $userObj->title = $data['title'];
        $userObj->name = $data['name'];
        $userObj->surname = $data['surname'];

        $userObj->birthdate = $data['birthdate'];

        $userObj->save();

        $userObj = $this->updateEmail($userObj, $data['email']);

        return $userObj;
    }

    public function updateEmail($userObj, $email){
        $userObj->email = $email;
        $userObj->save();

        //todo poslat email a overit ucet

        return $userObj;
    }




    public function destroy($userObj){

    }


}