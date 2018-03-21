<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 20.3.2018
 * Time: 23:10
 */

namespace App\Services\Users;


class UserEmailService
{
    public function update($userObj, $email){
        $userObj->email = $email;
        $userObj->save();

        //todo poslat email a overit ucet

        return $userObj;
    }

    public function notification($userObj){

    }

    public function validate($userObj, $code){

    }

}