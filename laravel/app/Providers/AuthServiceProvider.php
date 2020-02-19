<?php

namespace LaraCourse\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use LaraCourse\Album;
use LaraCourse\Models\Photo;
use LaraCourse\Policies\AlbumPolicy;
use LaraCourse\Policies\PhotoPolicy;
use LaraCourse\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'LaraCourse\Model' => 'LaraCourse\Policies\ModelPolicy',
        Album::class=> AlbumPolicy::class,
        Photo::class=>PhotoPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('manage-album',function (User $user,Album $album){
            return $user->id === $album->user_id;
        });
        Gate::define('view-album',function (User $user){
            return $user->type == 'provider';
        });
    }
}
