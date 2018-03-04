<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Like
 *
 * @property-read \App\Models\User    $author
 * @property-read \App\Models\Article $article
 * @property-read \App\Models\Comment $comment
 * @mixin \Eloquent
 */
class Like extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'author_id',

        'article_id',
        'comment_id',
    ];

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function article()
    {
        return $this->belongsTo('App\Models\Article', 'article_id');
    }

    public function comment()
    {
        return $this->belongsTo('App\Models\Comment', 'comment_id');
    }
}
