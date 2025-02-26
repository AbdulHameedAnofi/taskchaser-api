<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Notifications\UserCheckoutNotification;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\Contracts\CartRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct(protected CartRepositoryInterface $cartRepo)
    {
        $this->cartRepo = $cartRepo;
    }

    public function addToCart(CartRequest $request)
    {
        try {
            $cart = $this->cartRepo->addProductToCart($request->toArray());

            return $this->success(
                'Product added to cart successfully',
                Response::HTTP_CREATED,
                $cart
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function removeFromCart(string $productId)
    {
        try {
            $cart = $this->cartRepo->removeProductFromCart($productId);

            return $this->success(
                'Product removed from cart successfully',
                Response::HTTP_OK,
                $cart
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getCart()
    {
        try {
            $cart = $this->cartRepo->getCart();

            return $this->success(
                'Cart retrieved successfully',
                Response::HTTP_OK,
                $cart
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function checkoutCart()
    {
        try {
            $user = Auth::user();

            $user->notify(new UserCheckoutNotification($user));

            $cart = $this->cartRepo->checkoutCart();

        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
        
        return $this->success(
            'Cart checked out successfully',
            Response::HTTP_OK,
            $cart
        );
    }
}
