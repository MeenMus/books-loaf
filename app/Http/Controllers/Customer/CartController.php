<?php

namespace App\Http\Controllers\Customer;

use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends BaseController
{

    public function addCart(Request $request, $id)
    {
        try {
            $user = Auth::user();

            // Ensure the user has a cart
            $cart = $user->cart()->firstOrCreate([]);


            // Check if the book is already in the cart
            $item = $cart->items()->where('book_id', $id)->first();

            if ($item) {
                // Increment quantity if it exists
                $item->quantity += $request->quantity;
                $item->save();
            } else {
                // Add new cart item
                $cart->items()->create([
                    'book_id' => $id,
                    'quantity' => $request->quantity,
                ]);
            }

            Alert::success('Cart Updated!', 'Book has been successfully added to cart.');
            return redirect()->back();
        } catch (ValidationException $e) {
            Alert::error('Submission Error', $e->validator->errors()->first());
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong. Please try again.');
            return redirect()->back();
        }
    }


    public function orderNow(Request $request, $id)
    {
        try {
            $user = Auth::user();

            // Ensure the user has a cart
            $cart = $user->cart()->firstOrCreate([]);


            // Check if the book is already in the cart
            $item = $cart->items()->where('book_id', $id)->first();

            if ($item) {
                // Increment quantity if it exists
                $item->quantity += $request->quantity;
                $item->save();
            } else {
                // Add new cart item
                $cart->items()->create([
                    'book_id' => $id,
                    'quantity' => $request->quantity,
                ]);
            }

            Alert::success('Cart Updated!', 'Book has been successfully added to cart.');
            return redirect('checkout');
        } catch (ValidationException $e) {
            Alert::error('Submission Error', $e->validator->errors()->first());
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong. Please try again.');
            return redirect()->back();
        }
    }

    public function addAllLiked()
    {
        $user = Auth::user();
        $cart = $user->cart()->firstOrCreate();

        foreach ($user->likes as $like) {
            $book = $like->book;

            if (!$book) continue;

            $item = $cart->items()->where('book_id', $book->id)->first();

            if ($item) {
                $item->quantity += 1;
                $item->save();
            } else {
                $cart->items()->create([
                    'book_id' => $book->id,
                    'quantity' => 1,
                ]);
            }
        }

        Alert::success('Success', 'All liked books added to cart.');
        return redirect()->back();
    }

    public function fetchCart()
    {
        $cart = Auth::user()->cart()->with('items.book')->first();
        $cartBooks = $cart ? $cart->items : collect();

        return response()->json([
            'html' => view('components.cart-dropdown-content', compact('cartBooks'))->render()
        ]);
    }


    public function index()
    {
        $cart = Auth::user()->cart()->with('items.book')->first();
        $cartItems = $cart ? $cart->items : collect();

        return view('cart', compact('cartItems'));
    }

    public function removeCart($id)
    {

        try {
            $user = Auth::user();

            // Make sure the item belongs to the user's cart
            $cartItem = \App\Models\CartItem::whereHas('cart', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->findOrFail($id);

            $cartItem->delete();

            Alert::success('Book Remove!', 'Book has been successfully removed from cart.');
            return redirect()->back();
        } catch (ValidationException $e) {
            Alert::error('Submission Error', $e->validator->errors()->first());
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong. Please try again.');
            return redirect()->back();
        }
    }


    public function updateCart(Request $request)
    {
        try {
            $action = $request->input('action');

            foreach ($request->input('items', []) as $itemId => $data) {
                CartItem::where('id', $itemId)->update(['quantity' => $data['quantity']]);
            }

            if ($action === 'checkout') {
                return redirect()->route('checkout');
            }

            Alert::success('Cart Updated!', 'Cart has been successfully updated.');
            return redirect()->back();
        } catch (ValidationException $e) {
            Alert::error('Submission Error', $e->validator->errors()->first());
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong. Please try again.');
            return redirect()->back();
        }
    }

    public function showCheckout()
    {
        $cart = Cart::with('items.book')->where('user_id', auth()->id())->first();

        return view('checkout', compact('cart'));
    }
}
