<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request;

class BookController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function index()
    {
        return view('admin.manage-books');
    }

    public function create()
    {
        return view('admin.create-books');
    }

    public function store(Request $request)
    {
        return view('admin.manage-books');
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
