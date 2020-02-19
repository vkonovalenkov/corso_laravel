<?php

namespace LaraCourse\Policies;

use LaraCourse\Models\User;
use LaraCourse\Album;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlbumPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Album $album)
    {
        return $user->id === $album->user_id;
    }

    /**
     * Determine whether the user can view the album.
     *
     * @param  \LaraCourse\Models\User  $user
     * @param  \LaraCourse\Album  $album
     * @return mixed
     */
    public function view(User $user, Album $album)
    {
        //dd($album.'--xx');
        return $user->id === $album->user_id;
    }

    /**
     * Determine whether the user can create albums.
     *
     * @param  \LaraCourse\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return 1;
    }

    /**
     * Determine whether the user can update the album.
     *
     * @param  \LaraCourse\Models\User  $user
     * @param  \LaraCourse\Album  $album
     * @return mixed
     */
    public function update(User $user, Album $album)
    {
        return $user->id === $album->user_id;
    }

    /**
     * Determine whether the user can delete the album.
     *
     * @param  \LaraCourse\Models\User  $user
     * @param  \LaraCourse\Album  $album
     * @return mixed
     */
    public function delete(User $user, Album $album)
    {
        return $user->id === $album->user_id;
    }

    /**
     * Determine whether the user can restore the album.
     *
     * @param  \LaraCourse\Models\User  $user
     * @param  \LaraCourse\Album  $album
     * @return mixed
     */
    public function restore(User $user, Album $album)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the album.
     *
     * @param  \LaraCourse\Models\User  $user
     * @param  \LaraCourse\Album  $album
     * @return mixed
     */
    public function forceDelete(User $user, Album $album)
    {
        //
    }
}
