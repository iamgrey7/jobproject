<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'status', 'role_id', 'first_name', 
        'last_name', 'dob', 'role_id', 'path_foto'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relasi 1 user hanya memiliki 1 role
    public function role() 
    { 
        return $this->belongsTo(Role::class); 
    }

    //function pengecekan role user
    public function hasRole($role) 
    { 
        return null !== $this->role()->where('role_name', $role)->first();
    }
}
