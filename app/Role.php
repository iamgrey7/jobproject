<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Role extends Model
{
    protected $fillable = [
        'role_name', 'description'
    ];

    // 1 role dapat dimiliki oleh banyak user
    public function users() 
    { 
        return $this->hasMany(User::class); 
    }
    
}
