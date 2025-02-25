<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Respositories\Contracts\CartRepositoryInterface;
use Illuminate\Support\Facades\Auth;
class CartRepository implements CartRepositoryInterface
{
    public function addProductToCart(array $data)
    {
        $user = Auth::user();

        return Cart::create([
            'user_id' => $user->id,
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity'] ?? 1,
            'total' => $data['total'],
        ]);
    }

    public function removeProductFromCart(int $productId)
    {
        Cart::where('id', $productId)->delete();
    }

    public function getCart()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id);

        return [
                'amount' => $cart->sum('total'),
                'details' => $cart->get(['id', 'quantity', 'total'])
            ];
    }

    public function checkoutCart()
    {
        $user = Auth::user();

        $carts = Cart::where('user_id', $user->id)->get();

        foreach ($carts as $cart) {
            $cart->delete();
        }
    }
}