<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function addProduct(array $data);

    public function getProducts();
}