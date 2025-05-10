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
            Alert::error('Cannot delete', 'This genre is still used by one or more books.');
            return redirect()->back();
        }

        $genre->delete();
        Alert::success('Genre deleted!', 'Genre has been successfully deleted.');
        return redirect()->back();
    }
}
