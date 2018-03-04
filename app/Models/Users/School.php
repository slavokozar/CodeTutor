<?php

namespace App\Models\Users;

use App\Classes\SchoolRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\School
 *
 * @mixin \Eloquent
 */
class School extends Model
{
    use SoftDeletes;

    protected $table = 'schools';

    protected $fillable = [
        'name',
        'code',
        'address',
        'url'
    ];


    public function users(){
        return $this->belongsToMany(User::class, 'school_user', 'user_id', 'school_id')->withPivot(['role']);
    }

    public function admins()
    {
        return $this->users()->wherePivot('role',SchoolRoles::admin);
    }

    public function teachers()
    {
        return $this->users()->wherePivot('role',SchoolRoles::teacher);
    }

    public function students()
    {
        return $this->users()->wherePivot('role', SchoolRoles::student);
    }


}
