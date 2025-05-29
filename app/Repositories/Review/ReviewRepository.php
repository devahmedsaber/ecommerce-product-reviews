<?php

namespace App\Repositories\Review;

use App\Models\Review;
use App\Repositories\Review\ReviewRepositoryInterface;

class ReviewRepository implements ReviewRepositoryInterface
{
    public function all($request)
    {
        return Review::with('user', 'product')->paginate($request->per_page ?? 5);
    }

    public function create(array $data)
    {
        return Review::create($data);
    }

    public function update($id, array $data)
    {
        $review = Review::findOrFail($id);
        $review->update($data);
        return $review;
    }

    public function delete($id)
    {
        return Review::findOrFail($id)->delete();
    }

    public function findByUserAndProduct($userId, $productId)
    {
        return Review::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
    }
}
