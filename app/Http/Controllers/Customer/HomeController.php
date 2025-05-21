<?php

namespace App\Http\Controllers\Customer;

use App\Models\Genre;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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

    public function showCheckout()
    {
        return view('checkout');
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
}
