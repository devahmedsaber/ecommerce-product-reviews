<?php

namespace App\Repositories\Review;

use App\Exceptions\GeneralException;
use App\Models\Review;
use App\Repositories\Review\ReviewRepositoryInterface;
use App\Traits\ApiResponse;

class ReviewRepository implements ReviewRepositoryInterface
{
    use ApiResponse;

    protected $review;

    public function __construct()
    {
        $this->review = new Review();
    }

    public function all($request)
    {
        return $this->review->with('user', 'product')->paginate($request->per_page ?? 5);
    }

    public function create(array $data)
    {
        return $this->review->create($data);
    }

    public function update($id, array $data)
    {
        $review = $this->review->find($id);
        if (!$review) {
            throw new GeneralException(__('reviews.not_found'), 404);
        }
        $review->update($data);
        return $review;
    }

    public function delete($id)
    {
        $review = $this->review->find($id);
        if (!$review) {
            throw new GeneralException(__('reviews.not_found'), 404);
        }
        return $review->delete();
    }

    public function findByUserAndProduct($userId, $productId)
    {
        return $this->review->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
    }
}
