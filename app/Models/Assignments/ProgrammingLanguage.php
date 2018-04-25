<?php

namespace App\Models\Assignments;

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
