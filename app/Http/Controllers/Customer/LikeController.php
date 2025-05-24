<?php

namespace App\Http\Controllers\Customer;

use App\Models\Book;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class LikeController extends BaseController
{

    public function toggleLike($id)
    {
        $user = Auth::user();

        try {
            $like = Like::where('user_id', $user->id)
                ->where('book_id', $id)
                ->first();

            if ($like) {
                $like->delete();
                Alert::info('Like removed', 'You unliked this book.');
            } else {
                Like::create([
                    'user_id' => $user->id,
                    'book_id' => $id,
                ]);
                Alert::success('Liked!', 'You liked this book!');
            }

            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong.')->html();
            return redirect()->back();
        }
    }


    public function fetchLikes()
    {
        $likedBooks = Auth::user()->likes()->with('book')->get();

        // Return partial view or JSON
        return response()->json([
            'html' => view('components.likes-dropdown-content', compact('likedBooks'))->render()
        ]);
    }
}
