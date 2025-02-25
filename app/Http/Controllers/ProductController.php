<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'about' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        try {
            $product = $this->productRepo->addProduct($request->toArray());

            return $this->success(
                'Product added successfully',
                Response::HTTP_CREATED,
                $product
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getProducts()
    {
        try {
            $products = $this->productRepo->getProducts();

            return $this->success(
                'Products retrieved successfully',
                Response::HTTP_OK,
                $products
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
