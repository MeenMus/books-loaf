<?php

namespace App\Http\Controllers\Customer;

use App\Models\Book;
use App\Models\Order;
use App\Models\BookReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class BookReviewController extends BaseController
{
    public function index()
    {

    }

    public function submitReview(Request $request)
{   
     try {
    $request->validate([
        'book_id' => 'required|exists:books,id',
        'rating' => 'required|integer|between:1,5',
        'review' => 'required|string|max:1000',
    ]);

    BookReview::create([
        'user_id' => auth()->id(),
        'book_id' => $request->book_id,
        'rating' => $request->rating,
        'review' => $request->review,
    ]);

    
     Alert::success('Thank You', 'Your Review has been Submitted');
            return redirect()->back();
        } catch (ValidationException $e) {
            Alert::error('Submission Error', $e->validator->errors()->first());
            return redirect()->back();
        }
        
    return redirect()->back()->with('review_success', 'Thank you for your review!');

}
}
