<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Respositories\Contracts\CartRepositoryInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(protected CartRepositoryInterface $cartRepo)
    {
        $this->cartRepo = $cartRepo;
    }

    public function addToCart(AddToCartRequest $request)
    {
        try {
            $cart = $this->cartRepo->addProductToCart($request->toArray());

            return $this->success(
                'Product added to cart successfully',
                Response::HTTP_CREATED,
                $cart
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function removeFromCart(int $productId)
    {
        try {
            $cart = $this->cartRepo->removeProductFromCart($productId);

            return $this->success(
                'Product removed from cart successfully',
                Response::HTTP_OK,
                $cart
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
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
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function checkoutCart()
    {
        try {
            $cart = $this->cartRepo->checkoutCart();

            return $this->success(
                'Cart checked out successfully',
                Response::HTTP_OK,
                [
                    
                ]
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
