<?php

namespace App\Http\Controllers\Customer;

use App\Models\Book;
use App\Models\Genre;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class ShopController extends BaseController
{

    public function index(Request $request, $id)
    {
        $genres = Genre::orderBy('name', 'asc')->get();

        $sort = $request->input('sort');
        $search = $request->input('search');

        if ($id === 'all') {
            $query = Book::query();
            $genre = (object) ['name' => 'ALL'];
        } else {
            $genre = Genre::findOrFail($id);
            $query = $genre->books();
        }

        // Include average rating from reviews for sorting
        $query->withAvg('reviews', 'rating');

        // Search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Sorting
        switch ($sort) {
            case 'name_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'price_low_high':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high_low':
                $query->orderBy('price', 'desc');
                break;
            case 'rating_high':
                $query->orderBy('reviews_avg_rating', 'desc');
                break;
            case 'rating_low':
                $query->orderBy('reviews_avg_rating', 'asc');
                break;
            default:
                $query->orderBy('title', 'asc');
                break;
        }

        $books = $query->paginate(12)->withQueryString();

        return view('shop', compact('genres', 'books', 'genre', 'sort', 'search'));
    }

    public function randomGenres()
    {
        $genres = Genre::inRandomOrder()->take(10)->get();
        return response()->json($genres);
    }
}
