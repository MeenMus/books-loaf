<?php

namespace App\Http\Controllers\Admin;

use App\Models\Genre;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class GenreController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function genreList()
    {
        $genres = Genre::get();
        return view('admin.genres-list', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Genre::create($request->only('name'));

        Alert::success('Genre added!', 'Genre has been succesfully added.');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $genre = Genre::find($request->id);

        $genre->delete();
        Alert::success('Genre deleted!', 'Genre has been successfully deleted.');

        return redirect()->back();
    }


}
