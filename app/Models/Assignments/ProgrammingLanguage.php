<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class ProgrammingLanguage extends Model
{
    protected $table = 'programming_languages';

    protected $fillable = [
        'code',
        'name'
    ];

}
