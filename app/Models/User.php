<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'username',
        'fullname',
        'email',
        'contact_number',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function pendingPurchases()
    {
        return $this->hasMany(PendingPurchases::class);
    }

    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function getAuthIdentifier()
    {
        return $this->username;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}
