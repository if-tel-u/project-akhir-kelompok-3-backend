<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'fullname',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function wishlist()
    {
        return $this->belongsToMany(Item::class, 'wishlists');
    }
}
