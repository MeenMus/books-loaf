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
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class BookController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function bookList()
    {
        $books = Book::with('genres')->get();

        return view('admin.books-list', compact('books'));
    }

    public function create()
    {
        $genres = Genre::get();

        return view('admin.books-create', compact('genres'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'isbn' => 'required|string|size:13|unique:books,isbn',
                'description' => 'required|string|max:1000',
                'genre' => 'required|array|min:1',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            $coverImagePath = null;

            if ($request->hasFile('cover_image')) {
                $image = $request->file('cover_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                $resizedImage = Image::make($image)->fit(845, 1206, function ($constraint) {
                    $constraint->upsize();
                });

                $coverImagePath = 'covers/' . $imageName;
                Storage::disk('public')->put($coverImagePath, (string) $resizedImage->encode());
            }

            $book = Book::create([
                'title' => $request->title,
                'author' => $request->author,
                'isbn' => $request->isbn,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'cover_image' => $coverImagePath,
            ]);

            $book->genres()->attach($request->genre);

            Alert::success('Success!', 'Book created successfully!');
            return redirect()->back();
        } catch (ValidationException $e) {
            Alert::error('Submission Error', $e->validator->errors()->first());
            return redirect()->back();
        }
    }


    public function bookPage($id)
    {
        $book = Book::with('genres')->findOrFail($id);
        $genres = Genre::all();

        $genreNames = $book->genres->pluck('name')->toArray();

        $book->fields = [
            'Author' => $book->author,
            'Price' => number_format($book->price, 2),
            'Stock' => $book->stock,
            'Genre' => implode(', ', $genreNames),
        ];

        return view('admin.books-page', compact('book', 'genres'));
    }


    public function bookUpdate($id, Request $request)
    {
        try {
            $request->validate([
                'field' => 'required|string',
                'genre' => 'nullable|array',
                'genre.*' => 'exists:genres,id',
                'value' => 'nullable|string|max:1000', // for other fields
            ]);

            $book = Book::findOrFail($id);
            $field = $request->field;
            $value = $request->value;

            $fieldMap = [
                'Title' => 'title',
                'Author' => 'author',
                'Price' => 'price',
                'Stock' => 'stock',
                'ISBN' => 'isbn',
                'Genre' => 'genre', // special case handled below
                'Description' => 'description',
            ];

            if (!array_key_exists($field, $fieldMap)) {
                return back()->withErrors(['Invalid field']);
            }

            $dbField = $fieldMap[$field];

            if ($dbField === 'genre') {
                // Use pivot table syncing
                if ($request->has('genre') && count($request->genre) > 0) {
                    $book->genres()->sync($request->genre);
                }
            } else {
                $book->$dbField = $value;
                $book->save();
            }

            Alert::success('Book updated!', "$field updated successfully.");
            return redirect()->back();
        } catch (ValidationException $e) {
            Alert::error('Submission Error', $e->validator->errors()->first());
            return redirect()->back();
        }
    }


    public function bookUpdateCover($id, Request $request)
    {
        try {
            $request->validate([
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            $book = Book::findOrFail($id);

            if ($request->hasFile('cover_image')) {
                $image = $request->file('cover_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                $resizedImage = Image::make($image)->fit(845, 1206, function ($constraint) {
                    $constraint->upsize();
                });

                $coverImagePath = 'covers/' . $imageName;
                Storage::disk('public')->put($coverImagePath, (string) $resizedImage->encode());

                // Save path in DB
                $book->cover_image = $coverImagePath;
                $book->save();
            }

            Alert::success('Book updated!', "Cover updated successfully.");
            return redirect()->back();
        } catch (ValidationException $e) {
            Alert::error('Submission Error', $e->validator->errors()->first());
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        Alert::success('Deleted!', 'Book has been moved to trash.');
        return redirect('books-list');
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
