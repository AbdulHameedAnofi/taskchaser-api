<?php

namespace App\Respositories\Contracts;

interface CartRepositoryInterface
{
    public function addProductToCart(array $data);

    public function removeProductFromCart(int $productId);

    public function getCart();

    public function checkoutCart();
}