<?php

namespace App\Repositories\Review;

use Illuminate\Http\Request;

interface ReviewRepositoryInterface
{
    public function all(Request $request);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function findByUserAndProduct($userId, $productId);
}
