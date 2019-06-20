<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;

class ApiController extends Controller
{
    public function fetchAllReviews()
    {
        $reviews = Review::all();
        return response()->json($reviews);
    }
}
