<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductCollectionResource;
use App\Http\Resources\Product\ProductResource;
use App\Services\Product\ProductService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse;

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        return $this->success('Products Retrieved Successfully', new ProductCollectionResource($this->productService->all($request)));
    }

    public function show($id)
    {
        $product = $this->productService->find($id);

        if (!$product) {
            return $this->error(message: 'Product Not Found');
        }

        return $this->success('Product Retrieved Successfully', new ProductResource($product));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $product = $this->productService->create($data);
        return $this->success('Product Created Successfully', new ProductResource($product));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $data = $request->validated();
        $product = $this->productService->update($id, $data);
        return $this->success('Product Updated Successfully', new ProductResource($product));
    }

    public function destroy($id)
    {
        $this->productService->delete($id);
        return $this->success('Product Deleted Successfully');
    }
}
