<?php
namespace App\Services\Links;

use App\Models\Links\Link;

use Illuminate\Support\Facades\Response;

use Facades\App\Services\Utils\CleanString as CleanStringFacade;
use Facades\App\Services\Utils\UniqueCode as UniqueCodeFacade;

class LinkService
{
    public function all(){
        return Link::all();
    }

    public function paginate(){
        return Link::paginate(10);
    }

    private function get($code){
        return Link::where('code',$code)->first();
    }

    public function getOrFail($code){
        $fileObj = $this->get($code);

        if($fileObj == null){
            $this->fail($code);
        }
        return $fileObj;
    }

    public function findOrFail($id){
        $fileObj = Link::find($id);

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
        return new Link();
    }


    public function store($data, $authorObj){
        $normalized = CleanStringFacade::normalize($data['name']);

        $code = UniqueCodeFacade::unique(Link::class, $normalized);

        $fileObj = Link::create([
            'name' => $data['name'],
            'code' => $code,

            'author_id' => $authorObj->id,

            'url' => $data['url'],

            'description' => (isset($data['no-description']) && $data['no-description']) ? substr(strip_tags($data['text']), 0,160) : $data['description'],
        ]);

        return $fileObj;
    }

    public function update($fileObj, $data){
        if($data['name'] != $fileObj->name) {
            $normalized = CleanStringFacade::normalize($data['name']);

            $code = UniqueCodeFacade::unique(Link::class, $normalized);

            $fileObj->name = $data['name'];
            $fileObj->code = $code;
        }
        
        $fileObj->description = $data['description'];
        $fileObj->text = $data['text'];
        $fileObj->url = $data['url'];

        $fileObj->save();

        return $fileObj;
    }

    public function destroy($fileObj){
        $fileObj->delete();
    }

}