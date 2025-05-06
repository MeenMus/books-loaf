<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class BookController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function bookList()
    {
        $books = Book::get();
        $genres = Genre::all();

        foreach ($books as $book) {
            $genreIds = array_map('intval', explode(',', $book->genre));
            $book->genre_names = $genres->whereIn('id', $genreIds)->pluck('name')->toArray();
        }

        return view('admin.books-list', compact('books'));
    }

    public function create()
    {
        $genres = Genre::get();

        return view('admin.books-create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'description' => 'required',
            'genre' => 'required|array',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $coverImagePath = null;

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $resizedImage = Image::make($image)->fit(845, 1206, function ($constraint) {
                $constraint->upsize();
            });

            // Save to storage/app/public/covers
            $coverImagePath = 'covers/' . $imageName;
            Storage::disk('public')->put($coverImagePath, (string) $resizedImage->encode());
        }


        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'description' => $request->description,
            'genre' => implode(',', $request->genre),
            'price' => $request->price,
            'stock' => $request->stock,
            'cover_image' => $coverImagePath,
        ]);

        if ($book) {
            Alert::success('Success!', 'Book created successfully!');
        } else {

            Alert::error('Error!', $book?->getMessage() ?? 'Book creation failed.');
        }

        return redirect()->back();
    }


    public function bookPage($id)
    {
        $book = Book::where('id', '=', $id)->get()->first();
        $genres = Genre::all();


        $genreIds = array_map('intval', explode(',', $book->genre));
        $book->genre_names = $genres->whereIn('id', $genreIds)->pluck('name')->toArray();

        return view('admin.books-page', compact('book'));
    }








    public function malay()
    {
        return view('books.malay');
    }

    public function english()
    {
        return view('books.english');
    }

    public function chinese()
    {
        return view('books.chinese');
    }

    public function revision()
    {
        return view('books.revision');
    }

    public function stationery()
    {
        return view('books.stationery');
    }
}
