<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'role',        // admin, customer, etc.
        'status',      // active, blocked, etc.
        'username',    // new field for profile
        'phone',       // new field
        'birth',       // date of birth
        'gender',      // male/female/other
        'profile_image', // user profile photo
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
        'birth' => 'date',
        'role' => 'string',
    ];

    /**
     * Accessor: get full name if you ever split first/last name later.
     */
    public function getDisplayNameAttribute()
    {
        return $this->name ?? $this->username ?? 'User';
    }
}
