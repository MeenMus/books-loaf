<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends BaseController
{

    public function userList()
    {
        $users = User::get();

        return view('admin.users-list', compact('users'));
    }

    public function userPage($id)
    {
        $user = User::with('profile')->findOrFail($id);

        $user->fields = [
            'Name' => $user->name,
            'Email' => $user->email,
            'Role' => ucfirst($user->role),
        ];

        $profile = $user->profile;

        return view('admin.users-page', compact('user', 'profile'));
    }

    public function userProfileUpdate($id, Request $request)
    {
        try {

            $request->validate([
                'phone' => 'required|regex:/^\+?[1-9]\d{1,14}$/',
                'address_line_1' => 'required|string|max:255',
                'address_line_2' => 'nullable|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'postal_code' => 'required|string|max:20',
                'country' => 'required|string|max:255',
            ]);

            $profile = Profile::where('user_id', $id)->first();

            $profile->phone = $request->phone;


            $profile->address_line_1 = $request->address_line_1;
            $profile->address_line_2 = $request->address_line_2 ?? '';
            $profile->city = $request->city;
            $profile->state = $request->state;
            $profile->postal_code = $request->postal_code;
            $profile->country = $request->country;

            $profile->save();

            Alert::success('Profile updated!', 'Profile has been successfully updated.');
            return redirect()->back();
        } catch (ValidationException $e) {
            Alert::error('Submission Error', $e->validator->errors()->first());
            return redirect()->back();
        }
    }

    public function userRoleUpdate(Request $request, $id)
    {

        try {
            $request->validate([
                'role' => 'required|in:admin,customer',
            ]);

            $user = User::findOrFail($id);
            $user->role = $request->role;
            $user->save();

            Alert::success('Role changed!', 'User role has been successfully updated.');
            return back()->with('success', 'User role updated.');
        } catch (ValidationException $e) {
            Alert::error('Submission Error', $e->validator->errors()->first());
            return redirect()->back();
        }
    }


    public function userUpdate(Request $request, $id)
    {
        try {

            $request->validate([
                'field' => 'required|in:name,email,password',
                'value' => [
                    'required',
                    $request->field === 'email' ? 'email' : 'sometimes',
                    $request->field === 'password' ? 'min:6' : 'max:255',
                ],
            ]);

            $user = User::findOrFail($id);
            $field = $request->field;

            if ($request->field === 'password') {
                $user->password = Hash::make($request->value);
            } else {
                // If the email is being updated, remove the verified_at field
                if ($request->field === 'email') {
                    $user->email_verified_at = null;  // Remove verification timestamp
                }

                $user->{$request->field} = $request->value;
            }

            $user->save();

            // If email was updated, send a new verification email
            if ($request->field === 'email') {
                $user->sendEmailVerificationNotification();
            }

            Alert::success('User updated!', "$field updated successfully.");
            return redirect()->back();
        } catch (ValidationException $e) {
            Alert::error('Submission Error', $e->validator->errors()->first());
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        Alert::success('User deleted!', 'User has been successfully deleted.');
        return redirect('/users-list');
    }
}
