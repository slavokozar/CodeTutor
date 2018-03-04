<?php

namespace App\Models\Users;

use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'code',
        'school_id',
        'birthdate'
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'user_group_user', 'group_id', 'user_id')->withPivot(['role']);
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'school_user', 'school_id', 'user_id')->withPivot(['role']);
    }

//    public function isGroupLecturer($groupId){
//        return $this->groups()->find($groupId)->pivot->lecturer;
//    }

//    public function solutions()
//    {
//        return $this->hasMany('App\Models\AssignmentSolution', 'user_id');
//    }

    public function isAdmin()
    {

        return ($this->email == 'slavo.kozar@gmail.com' || $this->email == 'kamil.triscik@gmail.com');
    }

    public function isArticleAuthor()
    {
        return $this->isAdmin();
    }
//
//    public function isAssignmentAuthor()
//    {
//        return $this->isAdmin();
//    }

//    public function avatar(){
//        if($this->email == 'slavo.kozar@gmail.com'){
//            return asset('img/avatar-slavo.png');
//        }else{
//            return asset('img/avatar-blank.png');
//        }
//
//
//    }
}
