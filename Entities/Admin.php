<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Modules\Core\Traits\HasApiTokens;
use Omaicode\MediaLibrary\HasMedia;
use Omaicode\MediaLibrary\InteractsWithMedia;
use Omaicode\Permission\Traits\HasRoles;

class Admin extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'last_login_at',
        'super_user'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'super_user' => 'boolean'
    ];

    protected $appends = [
        'avatar_url'
    ];

    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = Hash::make($password);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatars')
        ->useFallbackUrl('/images/default-avatar.png')
        ->useFallbackPath(public_path('/images/default-avatar.png'));        
    }    

    public function getAvatarUrlAttribute()
    {
        return $this->getFirstMediaUrl('avatars');
    }
}