<?php

namespace App\Http\Controllers\Customer;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class BuyBookController extends BaseController
{

    public function index($id)
    {
        $book = Book::findOrFail($id);

        // Get all genre IDs for the current book
        $genreIds = $book->genres->pluck('id');

        // Get up to 10 related books from any of those genres, excluding the current book
        $relatedBooks = Book::whereHas('genres', function ($query) use ($genreIds) {
            $query->whereIn('genres.id', $genreIds);
        })
            ->where('books.id', '!=', $book->id)
            ->limit(10)
            ->get();


        return view('book', compact('book', 'relatedBooks'));
    }

}
