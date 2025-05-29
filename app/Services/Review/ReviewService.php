<?php

namespace App\Services\Review;

use App\Exceptions\DuplicateReviewException;
use App\Exceptions\GeneralException;
use App\Repositories\Review\ReviewRepositoryInterface;
use Exception;

class ReviewService
{
    protected $reviewRepository;

    public function __construct(ReviewRepositoryInterface $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function all($request)
    {
        return $this->reviewRepository->all($request);
    }

    public function create(array $data)
    {
        $data['user_id'] = auth()->id();

        // Check Duplicate Review
        $existing = $this->reviewRepository->findByUserAndProduct($data['user_id'], $data['product_id']);
        if ($existing) {
            throw new GeneralException('You Already Reviewed This Product.', 400);
        }

        return $this->reviewRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->reviewRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->reviewRepository->delete($id);
    }
}
