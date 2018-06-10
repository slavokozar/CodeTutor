<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 28.4.18
 * Time: 17:53
 */

namespace App\Models\Assignments;


use Illuminate\Database\Eloquent\Model;

class TestData extends Model
{

    protected $table = 'assignment_testdata';
    protected $fillable = [
        'assignment_id',
        'public',
        'number',
        'timeout',
        'description',
        'data'
    ];



    public function assignment(){
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

}