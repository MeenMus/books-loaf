<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PaymentController extends BaseController
{
    //
    public function index()
    {
        return view('payment.index'); 
    }
}
