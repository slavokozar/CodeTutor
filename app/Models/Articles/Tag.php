<?php

namespace App\Models;

use App\Models\Articles\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tag extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'series_id')->orderBy('series_order');
    }


}
