<?php

namespace App\Repositories\Contracts;

interface CartRepositoryInterface
{
    public function addProductToCart(array $data);

    public function removeProductFromCart(string $productId);

    public function getCart();

    public function checkoutCart();
}