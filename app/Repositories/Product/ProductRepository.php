<?php

namespace App\Repositories\Product;

use App\Exceptions\GeneralException;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Traits\ApiResponse;

class ProductRepository implements ProductRepositoryInterface
{
    use ApiResponse;

    protected $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function all($request)
    {
        $products = $this->product->with('reviews')->withAvg('reviews', 'rating');
        // Filter By Rating
        if ($request->has('min_rating')) {
            $products->having('reviews_avg_rating', '>=', $request->min_rating);
        }
        // Sort By Rating
        if ($request->has('sort_by_rating')) {
            $direction = $request->sort_by_rating === 'asc' ? 'asc' : 'desc';
            $products->orderBy('reviews_avg_rating', $direction);
        }
        return $products->paginate($request->per_page ?? 5);
    }

    public function find($id)
    {
        $product = $this->product->with('reviews')->withAvg('reviews', 'rating')->find($id);
        if (!$product) {
            throw new GeneralException(__('products.not_found'), 404);
        }
        return $product;
    }

    public function create(array $data)
    {
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $data['image']->store('products', 'public');
        }
        return $this->product->create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->product->find($id);
        if (!$product) {
            throw new GeneralException(__('products.not_found'), 404);
        }
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            if ($product->image && file_exists(public_path('storage/' . $product->image))) {
                unlink(public_path('storage/' . $product->image));
            }
            $data['image'] = $data['image']->store('products', 'public');
        }
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = $this->product->find($id);
        if (!$product) {
            throw new GeneralException(__('products.not_found'), 404);
        }
        if (isset($product->image) && file_exists(public_path('storage/' . $product->image))) {
            unlink(public_path('storage/' . $product->image));
        }
        return $product->delete();
    }
}
