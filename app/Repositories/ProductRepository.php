<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function addProduct(array $data)
    {
        return Product::create([
            'name' => $data['name'],
            'about' => $data['about'],
            'amount' => $data['amount'],
        ]);
    }

    public function getProducts()
    {
        return Product::all();
    }
}