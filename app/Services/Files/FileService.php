<?php
namespace App\Services\Files;

use App\Models\Files\File;

use Illuminate\Support\Facades\Response;

use Facades\App\Services\Utils\CleanString as CleanStringFacade;
use Facades\App\Services\Utils\UniqueCode as UniqueCodeFacade;

class FileService
{
    public function all(){
        return File::all();
    }

    public function paginate(){
        return File::paginate(10);
    }

    private function get($code){
        return File::where('code',$code)->first();
    }

    public function getOrFail($code){
        $fileObj = $this->get($code);

        if($fileObj == null){
            $this->fail($code);
        }
        return $fileObj;
    }

    public function findOrFail($id){
        $fileObj = File::find($id);

        if($fileObj == null){
            $this->fail($id);
        }
        return $fileObj;
    }


    private function fail($code)
    {
        Response::make('User ' . $code . 'not found!', 404)->throwResponse();
    }



    public function comments($fileObj){
        return $fileObj->comments()->limit(5)->get();
    }

    public function blank(){
        return new File();
    }


    public function store($data, $authorObj){
        $normalized = CleanStringFacade::normalize($data['name']);

        $code = UniqueCodeFacade::unique(File::class, $normalized);

        $fileObj = File::create([
            'name' => $data['name'],
            'code' => $code,

            'author_id' => $authorObj->id,

            'description' => (isset($data['no-description']) && $data['no-description']) ? substr(strip_tags($data['text']), 0,160) : $data['description'],
        ]);

        return $fileObj;
    }

    public function update($fileObj, $data){
        if($data['name'] != $fileObj->name) {
            $normalized = CleanStringFacade::normalize($data['name']);

            $code = UniqueCodeFacade::unique(File::class, $normalized);

            $fileObj->name = $data['name'];
            $fileObj->code = $code;
        }

        $fileObj->description = $data['description'];
        $fileObj->text = $data['text'];

        $fileObj->save();

        return $fileObj;
    }

    public function destroy($fileObj){
        $fileObj->delete();
    }

}