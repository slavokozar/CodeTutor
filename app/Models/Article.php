<?php

namespace App\Models;

use App\Scopes\PublicScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Article
 *
 * @property integer                                                                $id
 * @property string                                                                 $code
 * @property integer                                                                $author_id
 * @property integer                                                                $series_id
 * @property integer                                                                $series_order
 * @property string                                                                 $name
 * @property string                                                                 $content
 * @property string                                                                 $deleted_at
 * @property \Carbon\Carbon                                                         $created_at
 * @property \Carbon\Carbon                                                         $updated_at
 * @property-read \App\Models\User                                                  $author
 * @property-read \App\Models\Series                                                $series
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ArticleTag[] $tags
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereAuthorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereSeriesId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereSeriesOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'is_public',

        'author_id',
        'series_id',
        'series_order',

        'description',
        'text'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PublicScope);
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function series()
    {
        return $this->belongsTo('App\Models\Series', 'series_id');
    }

    public function tags()
    {
        return $this->hasMany('App\Models\ArticleTag', 'article_tag_article', 'article_id', 'tag_id');
    }


    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'object_id')->where('object_type','article')->whereNull('reply_to_id')->orderBy('created_at', 'DESC');
    }

    public function commentType()
    {
        return 'article';
    }

    public function commentRoute()
    {
        return 'clanky';
    }

    public function isAuthor($user)
    {
        return $this->author_id == $user->id;
    }

    public function scopeWithPrivate($query)
    {
        return $query->withoutGlobalScope(new PublicScope());
    }

}