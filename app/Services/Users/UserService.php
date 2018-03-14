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

    public function update($userObj, $data){
        $userObj->name = $data['name'];
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