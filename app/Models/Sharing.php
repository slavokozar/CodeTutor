<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 17.4.2018
 * Time: 23:55
 */

namespace App\Models;


use App\Models\Users\Group;
use App\Models\Users\School;
use Facades\App\Services\Assignments\AssignmentService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Facades\App\Services\Articles\ArticleService;

class Sharing extends Model
{
    use SoftDeletes;

    protected $table = 'feed_sharings';

    protected $fillable = [
        'school_id',
        'group_id',

        'object_type',
        'object_id'
    ];

    public function school(){
        return $this->belongsTo(School::class, 'school_id');
    }

    public function group(){
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function object(){
        if($this->object_type == 'article'){
            return ArticleService::findOrFail($this->object_id);
        }else if($this->object_type == 'assignment'){
            return AssignmentService::findOrFail($this->object_id);
        }else if($this->object_type == 'link'){

        }else if($this->object_type == 'file'){

        }
    }


}