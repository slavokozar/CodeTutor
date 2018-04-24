<?php

namespace App\Models;

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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArticleTag whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArticleTag whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArticleTag whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArticleTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArticleTag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ArticleTag extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tag'
    ];




}
