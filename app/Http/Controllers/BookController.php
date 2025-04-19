<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    //
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
