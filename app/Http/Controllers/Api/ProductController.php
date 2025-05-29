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
        return $this->success(__('products.retrieved'), new ProductCollectionResource($this->productService->all($request)));
    }

    public function show($id)
    {
        $product = $this->productService->find($id);
        return $this->success(__('products.showed'), new ProductResource($product));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $product = $this->productService->create($data);
        return $this->success(__('products.created'), new ProductResource($product));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $data = $request->validated();
        $product = $this->productService->update($id, $data);
        return $this->success(__('products.updated'), new ProductResource($product));
    }

    public function destroy($id)
    {
        $this->productService->delete($id);
        return $this->success(__('products.deleted'));
    }
}
