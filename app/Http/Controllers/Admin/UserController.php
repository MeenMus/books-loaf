<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profile;
use App\Models\User;
use App\Models\Genre;
use App\Models\Book;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{

    public function userList()
    {
        $users = User::get();

        return view('admin.users-list', compact('users'));
    }

    public function userPage($id, Request $request)
    {
        $user = User::with('profile')->findOrFail($id);

        $user->fields = [
            'Name' => $user->name,
            'Email' => $user->email,
            'Role' => ucfirst($user->role),
        ];

        $profile = $user->profile;

        $query = $user->orders()->with('orderItems.book');


        // Search by order ID
        if ($request->filled('search')) {
            $query->where('id', $request->search);
        }

        // Filter between dates
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        // Sorting
        $sort = $request->input('sort', 'latest'); // Default to latest
        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc'); // Default: latest
        }

        $orders = $query->paginate(5)->withQueryString();

        $topBooks = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('books', 'books.id', '=', 'order_items.book_id')
            ->select('books.title', DB::raw('SUM(order_items.quantity) as total_quantity'))
            ->where('orders.user_id', $id)
            ->groupBy('books.title')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        $bookLabels = $topBooks->pluck('title');
        $bookQuantities = $topBooks->pluck('total_quantity');

    
         // Get genre breakdown
        $genreData = DB::table('genres')
            ->join('book_genre', 'genres.id', '=', 'book_genre.genre_id')
            ->join('books', 'books.id', '=', 'book_genre.book_id')
            ->join('order_items', 'order_items.book_id', '=', 'books.id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.user_id', $id)
            ->select('genres.name', DB::raw('COUNT(DISTINCT books.id) as total'))
            ->groupBy('genres.name')
            ->get();

        // Separate labels and data
        $genreLabels = $genreData->pluck('name');
        $genreCounts = $genreData->pluck('total');

        return view('admin.users-page', compact('user', 'profile', 'orders', 'topBooks', 'genreLabels', 'genreCounts', 'bookLabels', 'bookQuantities'));
    }

    public function userProfileUpdate($id, Request $request)
    {
        try {

            $request->validate([
                'phone' => 'regex:/^\+?[1-9]\d{1,14}$/',
                'address_line_1' => 'string|max:255',
                'address_line_2' => 'nullable|string|max:255',
                'city' => 'string|max:255',
                'state' => 'string|max:255',
                'postal_code' => 'string|max:20',
                'country' => 'string|max:255',
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
