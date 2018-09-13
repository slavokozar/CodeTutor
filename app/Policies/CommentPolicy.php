<?php

namespace App\Policies;

use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    public function view(User $user, Post $post)
    {
        //uzivatel je clen skupiny, alebo spravca skoly

    }

    public function create()
    {
        //uzivatel je spravca skupiny, alebo skoly
    }

    public function update()
    {
        //uzivatel je spravca skupiny, alebo skoly
    }

    public function delete()
    {
        //uzivatel je spravca skupiny, alebo skoly
    }
}
