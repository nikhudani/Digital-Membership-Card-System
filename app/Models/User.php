<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Roles\Role;
use App\Models\Roles\RoleGroup;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'is_ban',
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
        'password' => 'hashed',
    ];
    
    public function role()
    {
        return $this->hasOneThrough(
            Role::class,
            RoleGroup::class,
            'user_id', // Foreign key on the RoleGroup model
            'id', // Local key on the User model
            'id', // Local key on the RoleGroup model
            'role_id' // Foreign key on the Role model
        );
    }

    public function checkRole() 
    {
        return $this->belongsToMany(Role::class, 'role_groups', 'user_id', 'role_id');
    }
    
    public function hasRole(...$roles)
    {
        return $this->role()->whereIn('name', $roles)->exists();
    }

    public function details() {
        return $this->hasOne(UserDetail::class)->withDefault([
            'image'         => 'default.svg',
            'is_active'     => 0
        ]);
    }

}
