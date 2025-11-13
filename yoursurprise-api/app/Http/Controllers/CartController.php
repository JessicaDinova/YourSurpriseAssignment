<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function show($id)
    {
        $cart = Cart::with(['items.product', 'userInfo'])
            ->find($id);

        if (!$cart) {
            return response()->json([
                'error' => 'Cart not found',
                'message' => 'The cart with ID ' . $id . ' does not exist.'
            ], 404);
        }

        $cartTotal = 0;

        $cart->items->each(function ($item) use (&$cartTotal){
            $discount = $item->discount_percentage ?? 0;
            $item->discounted_price = round($item->unit_price * (1 - $discount / 100), 2);
            $item->total_items_price = round($item->discounted_price * $item->quantity, 2);
            $cartTotal += $item->total_items_price;
    });
    
    $cart->grand_total = round($cartTotal ,2);   
    return response()->json($cart);
    }
}
