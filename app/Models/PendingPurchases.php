<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingPurchases extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
    ];
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
