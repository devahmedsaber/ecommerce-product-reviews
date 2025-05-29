<?php

namespace App\Http\Requests\Review;

use App\Exceptions\GeneralException;
use App\Http\Requests\ApiRequest;
use App\Models\Review;

class UpdateReviewRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $reviewId = $this->route('id');
        $review = Review::find($reviewId);
        if (!$review) {
            throw new GeneralException(__('reviews.not_found'), 404);
        }
        return auth()->check() && auth()->id() === $review?->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rating' => 'sometimes|required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ];
    }
}
