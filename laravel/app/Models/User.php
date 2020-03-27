<?php

namespace LaraCourse\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use LaraCourse\Album;
use LaraCourse\Models\AlbumCategory;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];
    protected $dates = [
      'created_at',
      'updated_at',
      'deleted_at'
    ];
    protected $dateFormat = 'Y-m-d H:i:s';
// protected $table = 'galery_users';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function albums()
    {
        return $this->hasMany(Album::class);
    }
    public function getFullNameAttribute(){
        return $this->name;
    }

    public function albumCategories()
    {
        return $this->hasMany(AlbumCategory::class);
    }
    public function isAdmin(){
        return $this->role === 'admin';
    }
}
