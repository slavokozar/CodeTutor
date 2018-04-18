<?php
/**
 * Created by PhpStorm.
 * School: slavo
 * Date: 2.3.18
 * Time: 23:44
 */

namespace App\Services\Users\Schools;

use App\Models\Users\School;
use Illuminate\Support\Facades\Response;

class SchoolService
{
    public function all()
    {
        //todo scope
        return School::all();
    }

    public function getOrFail($code)
    {
        $schoolObj = $this->get($code);

        if ($schoolObj == null) {
            $this->fail($code);
        } else {
            return $schoolObj;
        }
    }

    private function get($code)
    {
        return School::where('code', $code)->first();
    }


    public function findOrFail($id)
    {
        $schoolObj = School::find($id);

        if ($schoolObj == null) {
            $this->fail(id);
        } else {
            return $schoolObj;
        }
    }


    private function fail($code)
    {
        Response::make('School ' . $code . 'not found!', 404);
    }

    
    public function blank(){
        return new School();
    }


    public function create($data){
        $data['code'] = uniqid();
        $schoolObj = School::create($data);

        return $schoolObj;
    }




    public function update($schoolObj, $data){
        $schoolObj->name = $data['name'];
        $schoolObj->address = $data['address'];

        $schoolObj->url = $data['url'];

        $schoolObj->save();

        return $schoolObj;
    }
    

    public function destroy($schoolObj){

    }

}