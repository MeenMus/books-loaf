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

        $genre = Genre::findOrFail($id);

        // Sorting
        $sort = $request->input('sort');
        $query = $genre->books();

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
                $query->orderBy('rating', 'desc');
                break;
            case 'rating_low':
                $query->orderBy('rating', 'asc');
                break;
            default:
                // Optional: default sorting
                $query->orderBy('title', 'asc');
                break;
        }

        $books = $query->paginate(12)->withQueryString(); // Maintain query params like sort

        return view('shop', compact('genres', 'books', 'genre', 'sort'));
    }
}
