<?php

namespace App\Policies;

use App\User;
use App\Contest;
use Illuminate\Auth\Access\HandlesAuthorization;

class contestPolicy
{
    use HandlesAuthorization;

    public function before(User $user){
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the contest.
     *
     * @param  \App\User  $user
     * @param  \App\Contest  $contest
     * @return mixed
     */
    public function view(User $user, Contest $contest){
        return true;
    }

    /**
     * Determine whether the user can create contests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user){
        return true;
    }

    /**
     * Determine whether the user can update the contest.
     *
     * @param  \App\User  $user
     * @param  \App\Contest  $contest
     * @return mixed
     */
    public function update(User $user, Contest $contest) {
        return $user->id === $contest->user_id;
    }

    /**
     * Determine whether the user can delete the contest.
     *
     * @param  \App\User  $user
     * @param  \App\Contest  $contest
     * @return mixed
     */
    public function delete(User $user, Contest $contest) {
        return $user->id === $contest->user_id;
    }

    /**
     * Determine whether the user can restore the contest.
     *
     * @param  \App\User  $user
     * @param  \App\Contest  $contest
     * @return mixed
     */
    public function restore(User $user, Contest $contest){
        return $user->id === $contest->user_id;
    }

    /**
     * Determine whether the user can permanently delete the contest.
     *
     * @param  \App\User  $user
     * @param  \App\Contest  $contest
     * @return mixed
     */
    public function forceDelete(User $user, Contest $contest) {
        return $user->isAdmin();
    }

    /**
     * The one who has to see the contest is not the one who created it!
     * @param User $user
     * @param Contest $contest
     * @return bool
     */
    public function contest_public(User $user, Contest $contest){
        dd($user->id);
        return $user == null || $user->id != $contest->user_id ;
    }
}
