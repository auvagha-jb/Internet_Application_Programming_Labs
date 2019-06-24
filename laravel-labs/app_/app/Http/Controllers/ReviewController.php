<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Car;
use Illuminate\Support\Facades\DB;


class ReviewController extends Controller
{
    public function fetchReview($id)
    {
        $reviews = DB::table('reviews')
            ->where('reviews.car_id', '=', $id)
            ->get();
        return view('cars.fetchReview')->with('reviews', $reviews);
    }

    public function fetchReviewedCar($id)
    {
        $reviews = DB::table('cars')
            ->join('reviews', 'reviews.car_id', '=', 'cars.id')
            ->where('cars.id', '=', $id)
            ->get();
        return view('cars.fetchReviewedCar')->with('reviews', $reviews);   
    }

    public function fetchAllReviews()
    {
        $reviews = DB::table('cars')
            ->join('reviews', 'reviews.car_id', '=', 'cars.id')
            ->get();
        return view('cars.fetchAllReviews')->with('reviews',$reviews);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'car_id' => 'required',
            'review' => 'required',
        ],[
			'car_id.required' => 'Make is required',
			'review.required' => 'Model is required',
        ]);
        $review = new Review;
        $review->car_id = $request->input('car_id');
        $review->review = $request->input('review');
        $review->save();
        return $this->fetchAllReviews();
    }   
}