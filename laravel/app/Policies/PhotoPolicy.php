<?php

namespace LaraCourse\Policies;

use LaraCourse\User;
use LaraCourse\Models\Photo;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the photo.
     *
     * @param  \LaraCourse\User  $user
     * @param  \LaraCourse\Photo  $photo
     * @return mixed
     */
    public function view(User $user, Photo $photo)
    {
        $user->id === $photo->album->user_id;
    }

    /**
     * Determine whether the user can create photos.
     *
     * @param  \LaraCourse\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $user->id === $photo->album->user_id;
    }

    /**
     * Determine whether the user can update the photo.
     *
     * @param  \LaraCourse\User  $user
     * @param  \LaraCourse\Photo  $photo
     * @return mixed
     */
    public function update(User $user, Photo $photo)
    {
        $user->id === $photo->album->user_id;
    }

    /**
     * Determine whether the user can delete the photo.
     *
     * @param  \LaraCourse\User  $user
     * @param  \LaraCourse\Photo  $photo
     * @return mixed
     */
    public function delete(User $user, Photo $photo)
    {
        $user->id === $photo->album->user_id;
    }

    /**
     * Determine whether the user can restore the photo.
     *
     * @param  \LaraCourse\User  $user
     * @param  \LaraCourse\Photo  $photo
     * @return mixed
     */
    public function restore(User $user, Photo $photo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the photo.
     *
     * @param  \LaraCourse\User  $user
     * @param  \LaraCourse\Photo  $photo
     * @return mixed
     */
    public function forceDelete(User $user, Photo $photo)
    {
        //
    }
}
