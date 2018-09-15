<?php

namespace App\Models\Users;

use App\Classes\GroupRoles;
use App\Classes\SchoolRoles;
use App\Classes\UserRoles;

use App\Models\Links\Link;
use App\Models\Files\File;
use App\Models\Articles\Article;
use App\Models\Assignments\Assignment;
use App\Models\Assignments\Solution;

use App\Notifications\ResetPassword;

use App\Scopes\UserVisibilityScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;


/**
 * App\Models\User
 *
 * @property integer                                                                                                        $id
 * @property string                                                                                                         $name
 * @property string                                                                                                         $email
 * @property string                                                                                                         $code
 * @property string                                                                                                         $password
 * @property string                                                                                                         $remember_token
 * @property \Carbon\Carbon                                                                                                 $created_at
 * @property \Carbon\Carbon                                                                                                 $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[]                                              $groups
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[]                                               $roles
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    const TABLE_NAME = 'users';

    protected $table = User::TABLE_NAME;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'name',
        'surname',
        'email',
        'password',
        'code',
        'school_id',
        'birthdate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Send the password reset notification.
     *
     * @param  string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function fullName(){
        return $this->title . ' ' . $this->name . ' ' . $this->surname;
    }

    public function avatar(){
        return asset('img/avatar-blank.png');
    }


    public function groups()
    {
        return $this->belongsToMany(Group::class, 'user_group_user', 'group_id', 'user_id')->withPivot(['role']);
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'school_user', 'school_id', 'user_id')->withPivot(['role']);
    }


    public function links(){
        return $this->hasMany(Link::class, 'author_id');
    }

    public function files(){
        return $this->hasMany(File::class, 'author_id');
    }

    public function articles(){
        return $this->hasMany(Article::class, 'author_id');
    }

    public function assignments(){
        return $this->hasMany(Assignment::class, 'author_id');
    }

    public function solutions()
    {
        return $this->hasMany(Solution::class, 'user_id');
    }


    public function isAdmin()
    {
        return ($this->role == UserRoles::ADMIN);
    }

    public function isAuthor($object = null)
    {
        if($object != null){
            return $object->author_id == Auth::user()->id;
        }

        return (
            $this->role == UserRoles::ADMIN
            || $this->schools()->wherePivotIn('role', [SchoolRoles::ADMIN, SchoolRoles::TEACHER])->count() > 0
            || $this->groups()->wherePivotIn('role', [GroupRoles::TEACHER])->count() > 0
        );
    }

    public function scopeVisible($query)
    {
        $userObj = Auth::user();

        // admin can see anybody
        if (Auth::check() && !$userObj->isAdmin()) {

            // schools, in which logged user has admin or teacher role
            $schools = $userObj->schools()->wherePivotIn('role', [SchoolRoles::ADMIN, SchoolRoles::TEACHER])->pluck(School::TABLE_NAME . '.id');

            // groups, in which logged user has teacher role
            $groups = $userObj->groups()->wherePivot('role', GroupRoles::TEACHER)->pluck(Group::TABLE_NAME . '.id');

            return $query->where(function($query) use ($schools, $groups){
                if($schools->count() > 0)

                    $query->whereHas('schools', function ($query) use ($schools) {
                        $query->where(School::TABLE_NAME . '.id', $schools);
                    });

                if($groups->count() > 0)
                    $query->orWhereHas('groups', function ($query) use ($groups) {
                        $query->whereIn(Group::TABLE_NAME . '.id', $groups);
                    });

            });
        }

        return $query;
    }
}
