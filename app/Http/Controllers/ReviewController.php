<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function index()
    {
        $reviews =Review::with(['customer','product'])->paginate(env('PAGENATION_COUNT'));
        return view('admin.reviews.reviews', compact('reviews'));
    }
}
