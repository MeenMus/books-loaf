<?php

namespace App\Http\Controllers\Admin;

use App\Models\Genre;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class GenreController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function genreList()
    {
        $genres = Genre::get();

         // Top genres by total quantity sold
        $topGenres = DB::table('genres')
        ->select('genres.name', DB::raw('SUM(order_items.quantity) as total_quantity'))
        ->leftjoin('book_genre', 'genres.id', '=', 'book_genre.genre_id')
        ->join('order_items', 'book_genre.book_id', '=', 'order_items.book_id')
        ->groupBy('genres.name')
        ->orderByDesc('total_quantity')
        ->limit(5)
        ->get();

       
       
          return view('admin.genres-list', compact('genres', 'topGenres'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:genres,name',
            ]);
            Genre::create($request->only('name'));
            Alert::success('Genre added!', 'Genre has been successfully added.');

            return redirect()->back();
        } catch (ValidationException $e) {

            Alert::error('Submission Error', $e->validator->errors()->first());
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        $genre = Genre::findOrFail($request->id);

        if ($genre->books()->exists()) {
            Alert::error('Delete Failed!', 'This genre is still used by one or more books.');
            return redirect()->back();
        }

        $genre->delete();
        Alert::success('Genre deleted!', 'Genre has been successfully deleted.');
        return redirect()->back();
    }
}
