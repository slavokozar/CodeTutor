<?php
namespace App\Services;


use App\Models\Comment;
use App\Models\Article;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;


/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 16/09/2017
 * Time: 00:39
 */
class CommentService
{

    public function find($id){
        return Comment::find($id);
    }

    public function findOrFail($id){
        $commentObj = $this->find($id);

        if($commentObj == null){
            return null;
        }

        return $commentObj;
    }

    public function object($type, $code){
        if($type == 'zadania'){
            $object = Assignment::where('code',$code)->first();
        }elseif($type == 'clanky'){
            $object = Article::where('code',$code)->first();
        }else{
            $object = null;
        }

        return $object;
    }

    public function create($objectObj, $replyToObj, $data){
        $commentObj = Comment::create([
            'author_id' => Auth::user()->id,
            'object_type' => $objectObj->commentType(),
            'object_id' => $objectObj->id,
            'reply_to_id' => $replyToObj->id,
            'text' => $data['comment']
        ]);

        return $commentObj;
    }

    public function update($commentObj, $data){
        $commentObj->text = $data['comment'];
        $commentObj->save();

        return $commentObj;
    }

    public function delete($commentObj){
        $commentObj->delete();
    }
}