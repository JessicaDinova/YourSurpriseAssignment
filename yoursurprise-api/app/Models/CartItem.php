<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;
use App\Models\Cart;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items';

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function cart() {
        return $this->belongsTo(Cart::class, 'cart_id');
    }
}
