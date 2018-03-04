<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Group
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[]       $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Assignment[] $assignments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[]       $lecturer
 * @mixin \Eloquent
 */
class Group extends Model
{
    use SoftDeletes;

    protected $table = 'user_groups';

    protected $fillable = [
        'name',
        'code',
        'school_id',
        'is_public'
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'user_group_user', 'user_id', 'group_id')->withPivot(['role']);
    }

    public function teachers()
    {
        return $this->users()->wherePivot('role','teacher');
    }

    public function students()
    {
        return $this->users()->wherePivot('role', 'student');
    }

}
