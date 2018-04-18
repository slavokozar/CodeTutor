<?php

namespace App\Models\Articles;

use App\Models\Files\Attachment;
use App\Models\Files\Image;
use App\Models\Sharing;
use App\Models\Users\Group;
use App\Models\Users\School;
use App\Models\Users\User;
use App\Scopes\PublicScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Article
 *
 * @property integer $id
 * @property string $code
 * @property integer $author_id
 * @property integer $series_id
 * @property integer $series_order
 * @property string $name
 * @property string $content
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $author
 * @property-read \App\Models\Series $series
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

    protected $table = 'articles';

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


    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

//    public function tags()
//    {
//        return $this->hasMany('App\Models\ArticleTag', 'article_tag_article', 'article_id', 'tag_id');
//    }

    public function images()
    {
        return $this->hasMany(Image::class, 'object_id')->where('object_type', 'article');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'object_id')->where('object_type', 'article');
    }


    // SHARING
    public $sharingType = 'article';

    public function sharings(){
        return $this->hasMany(Sharing::class, 'object_id')->where('object_type', 'article');
    }

    public function sharingsGroups(){
        return $this->sharings()->whereNull('school_id')->whereNotNull('group_id');
    }

    public function sharingsSchools(){
        return $this->sharings()->whereNull('group_id')->whereNotNull('school_id');
    }


    // COMMENTS
    public $commentType = 'article';
    public $commentRoute = 'clanky';

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'object_id')->where('object_type', 'article')->whereNull('reply_to_id')->orderBy('created_at', 'DESC');
    }
}
