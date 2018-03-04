<?php
namespace App\Services\Articles;

use App\_Classes\UUID;
use App\Facades\CleanString;
use App\Models\Article;
use App\_Classes\Parsedown;

/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 16/09/2017
 * Time: 00:55
 */
class ArticleService
{
    public function all(){
        return Article::all();
    }

    public function get($code){
        return Article::where('code',$code)->first();
    }

    public function getOrFail($code){
        $articleObj = $this->get($code);

        if($articleObj == null){

        }
        return $articleObj;
    }


    public function content($articleObj){
        $parsedown = new Parsedown();

        return $parsedown->text($articleObj->text);
    }


    public function comments($articleObj){
        return $articleObj->comments()->limit(5)->get();
    }

    public function store($data){
        $normalized = CleanString::normalize($data['name']);

        do {
            $code = new UUID;
            $code = $code->limit(6, 4);
            $code = $normalized.'-'.$code;
        } while (count(Article::where('code', $code)->get()) > 0);

        $articleObj = Article::create([
            'name' => $data['name'],
            'code' => $code,
            'is_public' => isset($data['is_public']) && $data['is_public'] ? true : false,

            'author_id' => Auth::user()->id,
            'series_id' => null,
            'series_order' => null,

            'description' => $data['description'],
            'text' => $data['text']
        ]);

        return $articleObj;
    }

    public function update($articleObj, $data){
        if($data['name'] != $articleObj->name) {
            $normalized = CleanString::normalize($data['name']);

            do {
                $code = new UUID;
                $code = $code->limit(6, 4);
                $code = $normalized . '-' . $code;
            } while (count(Article::where('code', $code)->get()) > 0);

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

    public function delete($articleObj){
        $articleObj->delete();
    }
}