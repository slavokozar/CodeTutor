<?php

namespace App\Models;

use App\Models\Articles\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ArticleTag
 *
 * @property integer                                                             $id
 * @property string                                                              $name
 * @property string                                                              $deleted_at
 * @property \Carbon\Carbon                                                      $created_at
 * @property \Carbon\Carbon                                                      $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article[] $articles
 * @property-read \App\Models\Series                                             $series
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Series extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'author_id'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'series_id')->orderBy('series_order');
    }


}
