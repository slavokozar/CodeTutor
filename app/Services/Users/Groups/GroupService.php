<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 2.3.18
 * Time: 23:44
 */

namespace App\Services\Users\Groups;

use App\Models\Users\Group;
use Illuminate\Support\Facades\Response;

class GroupService
{
    public function all()
    {
        //todo scope
        return Group::all();
    }

    public function getOrFail($code)
    {
        $groupObj = $this->get($code);

        if ($groupObj == null) {
            $this->fail($code);
        } else {
            return $groupObj;
        }
    }

    public function get($code)
    {
        return Group::where('code', $code)->first();
    }

    public function findOrFail($id)
    {
        $groupObj = Group::find($id);

        if ($groupObj == null) {
            $this->fail(id);
        } else {
            return $groupObj;
        }
    }

    private function fail($code)
    {
        Response::make('Group ' . $code . 'not found!', 404);
    }

    public function blank(){
        return new Group();
    }


    public function create($data){
        $data['code'] = uniqid();
        $groupObj = Group::create($data);

        return $groupObj;
    }




    public function update($groupObj, $data){
        $groupObj->name = $data['name'];

        $groupObj->save();

        return $groupObj;
    }


    public function destroy($groupObj){

    }
}