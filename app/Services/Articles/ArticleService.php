<?php
namespace App\Services\Articles;

use App\Models\Articles\Article;

use Illuminate\Support\Facades\Response;

use Facades\App\Services\Utils\CleanString as CleanStringFacade;
use Facades\App\Services\Utils\UniqueCode as UniqueCodeFacade;

class ArticleService
{
    public function all(){
        return Article::all();
    }

    public function paginate(){
        return Article::paginate(10);
    }

    public function getOrFail($code){
        $articleObj = $this->get($code);

        if($articleObj == null){
            $this->fail($code);
        }
        return $articleObj;
    }

    private function get($code){
        return Article::where('code',$code)->first();
    }

    public function findOrFail($id){
        $articleObj = Article::find($id);

        if($articleObj == null){
            $this->fail($id);
        }
        return $articleObj;
    }


    private function fail($code)
    {
        Response::make('User ' . $code . 'not found!', 404)->throwResponse();
    }


    public function content($articleObj){
        $parsedown = new Parsedown();

        return $parsedown->text($articleObj->text);
    }


    public function comments($articleObj){
        return $articleObj->comments()->limit(5)->get();
    }

    public function blank(){
        return new Article();
    }


    public function store($data, $authorObj){
        $normalized = CleanStringFacade::normalize($data['name']);

        $code = UniqueCodeFacade::unique(Article::class, $normalized);

        $articleObj = Article::create([
            'name' => $data['name'],
            'code' => $code,
            'is_public' => isset($data['is_public']) && $data['is_public'] ? true : false,

            'author_id' => $authorObj->id,
            'series_id' => null,
            'series_order' => null,

            'description' => (isset($data['no-description']) && $data['no-description']) ? substr(strip_tags($data['text']), 0,160) : $data['description'],
            'text' => $data['text']
        ]);

        return $articleObj;
    }

    public function update($articleObj, $data){
        if($data['name'] != $articleObj->name) {
            $normalized = CleanString::normalize($data['name']);

            $normalized = CleanStringFacade::normalize($data['name']);

            $code = UniqueCodeFacade::unique(Article::class, $normalized);

            $articleObj->name = $data['name'];
            $articleObj->code = $code;
        }

        $articleObj->is_public = isset($data['is_public']) && $data['is_public'] ? true : false;

        $articleObj->series_id = null;
        $articleObj->series_order = null;

        $articleObj->description = $data['description'];
        $articleObj->text = $data['text'];

        $articleObj->save();

        return $articleObj;
    }

    public function destroy($articleObj){
        $articleObj->delete();
    }
}