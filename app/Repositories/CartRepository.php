<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\Cart;
use App\Models\Product;
use App\Http\Resources\CartsResource;
use App\Repositories\Contracts\CartRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CartRepository implements CartRepositoryInterface
{

    public function addProductToCart(array $data)
    {
        $user = Auth::user();

        return Cart::create([
            'user_id' => $user->id,
            'product_id' => $this->product($data['product'])->id,
            'quantity' => $data['quantity'] ?? 1,
            'total' => $this->product($data['product'])->amount * ($data['quantity'] ?? 1),
        ]);
    }

    public function removeProductFromCart(int $productId)
    {
        $cart = $this->user_cart()->where('id', $productId)->first();

        if ($cart) {
            $cart->delete();
        } else {
            throw new NotFoundException('Product not in cart');
        }
    }

    public function getCart()
    {
        $cart = $this->user_cart();

        return [
                'amount' => $cart->sum('total'),
                'details' => CartsResource::collection($cart->get())
            ];
    }

    public function checkoutCart()
    {
        $carts = $this->user_cart()->get();

        foreach ($carts as $cart) {
            $cart->delete();
        }
    }
    
    private function product(string $name)
    {
        return Product::where('name', $name)->first();
    }

    private function user_cart()
    {
        return Cart::where('user_id', Auth::id());
    }
}