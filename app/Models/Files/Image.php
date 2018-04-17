<?php

namespace App\Models\Files;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = [
        'object_id',
        'object_type',
        'code',
        'name',
        'ext'
    ];

    public function url($size = null){

        if($size == null){
            return asset('static-images/' . $this->code . '.' . $this->ext);
        }

    }
}
