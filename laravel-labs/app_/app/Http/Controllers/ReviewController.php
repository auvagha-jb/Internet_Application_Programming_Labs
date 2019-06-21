<?php

namespace App\Http\Controllers;

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
}