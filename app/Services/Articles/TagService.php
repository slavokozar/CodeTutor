<?php
namespace App\Services\Articles;

use App\Models\Article;
use App\Models\ArticleTag;

/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 16/09/2017
 * Time: 00:55
 */
class TagService
{
    public function all(){
        return ArticleTag::all();
    }
}