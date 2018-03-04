<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @mixin \Eloquent
 */
class Role extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role_user', 'role_id', 'user_id');
    }
}
