<?php

namespace App\Http\Controllers\Customer;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends BaseController
{

    public function create()
    {

        return view('profile');
    }


    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'regex:/^\+?[1-9]\d{1,14}$/',
                'address_line_1' => 'string|max:255',
                'address_line_2' => 'nullable|string|max:255',
                'city' => 'string|max:255',
                'state' => 'string|max:255',
                'postal_code' => 'string|max:20',
                'country' => 'string|max:255',
            ]);

            $user = Auth::user();
            $user->name = $request->name;
            $user->save();

            $user->profile->phone = $request->phone;
            $user->profile->address_line_1 = $request->address_line_1;
            $user->profile->address_line_2 = $request->address_line_2 ?? '';
            $user->profile->city = $request->city;
            $user->profile->state = $request->state;
            $user->profile->postal_code = $request->postal_code;
            $user->profile->country = $request->country;

            $user->profile->save();

            Alert::success('Profile updated!', 'Profile has been successfully updated.');
            return redirect()->back();
        } catch (ValidationException $e) {
            Alert::error('Submission Error', $e->validator->errors()->first());
            return redirect()->back();
        }
    }
}
