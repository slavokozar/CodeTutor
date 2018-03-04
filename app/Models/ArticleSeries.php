<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Series
 *
 * @property-read \App\Models\User                                               $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article[] $articles
 * @mixin \Eloquent
 */
class Series extends Model
{
    //use SoftDeletes;

    protected $fillable = [
        'name',
        'author_id'
    ];


    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

}
