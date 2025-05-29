<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function all($request)
    {
        return Product::with('reviews')->withAvg('reviews', 'rating')->paginate($request->per_page ?? 5);
    }

    public function find($id)
    {
        return Product::with('reviews')->withAvg('reviews', 'rating')->find($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }
}
