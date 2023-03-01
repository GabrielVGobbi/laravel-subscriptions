<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\ACL\Permission;
use App\Models\ACL\Role;
use App\Supports\Traits\HasPermissionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissionsTrait;

    protected $with = ['permissions', 'roles'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    public const RELATIONSHIP_USER_PERMISSION = 'users_permissions';

    public const RELATIONSHIP_USER_ROLE = 'users_roles';

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, self::RELATIONSHIP_USER_PERMISSION, 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, self::RELATIONSHIP_USER_ROLE, 'user_id');
    }
}
