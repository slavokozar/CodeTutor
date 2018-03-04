<?php

namespace App\Services\Users;

use App\Models\Group;

use Illuminate\Support\Facades\Auth;

/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 16/09/2017
 * Time: 01:27
 */
class GroupService
{

    public function all(){

        return Group::all();


        if(Auth::check()){
            return Auth::user()->groups;
        }else{
            return $this->publicGroups();
        }
    }
}