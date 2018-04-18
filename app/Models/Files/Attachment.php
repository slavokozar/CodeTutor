<?php

namespace App\Models\Files;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = 'attachments';

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
