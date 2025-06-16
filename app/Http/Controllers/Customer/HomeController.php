<?php

namespace App\Http\Controllers\Customer;

use App\Models\Genre;
use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\BookReview;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Payment;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function showIndex()
    {
        return view('index');
    }

    public function showBook()
    {
        return view('single-product');
    }

    public function showPost()
    {
        return view('single-post');
    }

    public function showShop()
    {

        $genres = Genre::orderBy('name', 'asc')->get();

        return view('shop', compact('genres'));
    }

    public function showIndexAlt()
    {
        return view('index-2');
    }

    public function showContact()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        SupportTicket::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open', // default status
        ]);
        Alert::success('success!', 'Your support ticket has been received. We’ll get back to you shortly!');
        return redirect()->back()->with('ticket_submitted', true);
    }

    public function showCart()
    {
        return view('cart');
    }

    public function showBlog()
    {
        return view('blog');
    }

    public function showAbout()
    {
        return view('about');
    }

    public function test()
    {
        $cart = Auth::user()->cart()->with('items.book')->first();

        $cartItems = $cart ? $cart->items : collect();

        $total = $cartItems->sum(fn($item) => $item->book->price);



        return response()->json([
            'html' => view('components.cart-dropdown-content', [
                'cartItems' => $cartItems,
                'total' => $total
            ])->render()
        ]);
    }
}
