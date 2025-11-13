<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\CartItem;
use App\Models\User;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    public function items() {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    public function userInfo() {
        return $this->belongsTo(User::class, 'user');
    }
}
