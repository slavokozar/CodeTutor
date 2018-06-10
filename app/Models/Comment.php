<?php

namespace App\Models;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Comment
 *
 * @property-read \App\Models\User    $author
 * @property-read \App\Models\Article $article
 * @property-read \App\Models\Article $replyTo
 * @mixin \Eloquent
 */
class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'comments';

    protected $fillable = [
        'author_id',
        'object_type',
        'object_id',
        'reply_to_id',
        'text'
    ];

    public function author(){
        return $this->belongsTo(User::class, 'author_id');
    }

    public function object(){
        if($this->object == 'assignment'){
            return $this->belongsTo('App\Models\Assignment', 'object_id');
        }elseif($this->object == 'article'){
            return $this->belongsTo('App\Models\Article', 'object_id');
        }
    }

    public function replies(){
        return $this->hasMany('App\Models\Comment', 'reply_to_id')->orderBy('created_at','ASC');
    }

    public function replyTo(){
        return $this->belongsTo('App\Models\Comment', 'reply_to_id');
    }

    public function canModify($user){
        return ($this->author_id == $user->id || Auth::user()->isAdmin);
    }
}
