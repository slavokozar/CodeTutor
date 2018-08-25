<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 17.4.2018
 * Time: 19:28
 */

namespace App\Models\Links;

use App\Models\Users\User;

use App\Models\Comment;
use App\Models\Sharing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use SoftDeletes;

    protected $table = 'links';

    protected $fillable = [
        'name',
        'code',

        'author_id',

        'description',
        'text',
        'url'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // SHARING
    public $sharingType = 'link';

    public function sharings(){
        return $this->hasMany(Sharing::class, 'object_id')->where('object_type', 'article');
    }

    public function sharingsGroups(){
        return $this->sharings()->whereNull('school_id')->whereNotNull('group_id');
    }

    public function sharingsSchools(){
        return $this->sharings()->whereNull('group_id')->whereNotNull('school_id');
    }


    // COMMENTS
    public $commentType = 'link';
    public $commentRoute = 'odkazy';

    public function comments()
    {
        return $this->hasMany(Comment::class, 'object_id')->where('object_type', 'article')->whereNull('reply_to_id')->orderBy('created_at', 'DESC');
    }
}