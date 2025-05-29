<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\StoreReviewRequest;
use App\Http\Requests\Review\UpdateReviewRequest;
use App\Http\Resources\Review\ReviewCollectionResource;
use App\Services\Review\ReviewService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use ApiResponse;

    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index(Request $request)
    {
        return $this->success(__('reviews.retrieved'), new ReviewCollectionResource($this->reviewService->all($request)));
    }

    public function store(StoreReviewRequest $request)
    {
        $review = $this->reviewService->create($request->validated());
        return $this->success(__('reviews.created'), $review);
    }

    public function update(UpdateReviewRequest $request, $id)
    {
        $review = $this->reviewService->update($id, $request->validated());
        return $this->success(__('reviews.updated'), $review);
    }

    public function destroy($id)
    {
        $this->reviewService->delete($id);
        return $this->success(__('reviews.deleted'));
    }
}
