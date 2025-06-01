<?php

namespace App\Http\Controllers\Customer;

use App\Mail\OrderPlacedMail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;

class PaymentController extends Controller
{

    public function redirectToStripeCheckout(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|regex:/^\+?[1-9]\d{1,14}$/',
                'address_line_1' => 'required|string|max:255',
                'address_line_2' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'state' => 'nullable|string|max:255',
                'postal_code' => 'nullable|string|max:20',
                'country' => 'required|string|max:255',
            ]);

            $user = auth()->user();
            $cart = $user->cart()->with('items.book')->first();

            if (!$cart || $cart->items->isEmpty()) {
                return back()->with('error', 'Your cart is empty.');
            }

            $lineItems = [];

            foreach ($cart->items as $item) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'myr',
                        'product_data' => [
                            'name' => $item->book->title,
                        ],
                        'unit_amount' => $item->book->price * 100, // in cents
                    ],
                    'quantity' => $item->quantity,
                ];
            }

            // Optional: Add flat shipping
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'myr',
                    'product_data' => [
                        'name' => 'Shipping Fee',
                    ],
                    'unit_amount' => 1000, // RM10
                ],
                'quantity' => 1,
            ];

            Stripe::setApiKey(config('services.stripe.secret'));

            $session = Session::create([
                'payment_method_types' => ['card', 'fpx'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout-success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout-cancel'),
                'metadata' => [
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'country' => $request->country,
                    'state' => $request->state,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code,
                    'address_line_1' => $request->address_line_1,
                    'address_line_2' => $request->address_line_2,
                ],
            ]);

            return redirect($session->url);
        } catch (ValidationException $e) {
            Alert::error('Submission Error', $e->validator->errors()->first());
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong. Please try again.');
            return redirect()->back();
        }
    }


    public function stripeSuccess(Request $request)
    {
        $order = null;

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::retrieve($request->get('session_id'));

        $paymentIntent = PaymentIntent::retrieve($session->payment_intent);
        $paymentMethod = PaymentMethod::retrieve($paymentIntent->payment_method);

        $user = User::find($session->metadata->user_id);
        $cart = $user->cart()->with('items.book')->first();

        DB::transaction(function () use (&$order, $session, $user, $cart, $paymentIntent, $paymentMethod) {
            $total = $cart->items->sum(fn($item) => $item->book->price * $item->quantity + 10);

            $order = $user->orders()->create([
                'total_price' => $total,
                'status' => 'pending',
                'name' => $session->metadata->name,
                'email' => $session->metadata->email,
                'phone' => $session->metadata->phone,
                'country' => $session->metadata->country,
                'state' => $session->metadata->state,
                'city' => $session->metadata->city,
                'postal_code' => $session->metadata->postal_code,
                'address_line_1' => $session->metadata->address_line_1,
                'address_line_2' => $session->metadata->address_line_2,
            ]);

            foreach ($cart->items as $item) {
                $order->orderItems()->create([
                    'book_id' => $item->book_id,
                    'quantity' => $item->quantity,
                    'price' => $item->book->price,
                ]);

                // Reduce book stock
                $book = $item->book;
                if ($book->stock >= $item->quantity) {
                    $book->stock -= $item->quantity;
                    $book->save();
                } else {
                    throw new \Exception("Insufficient stock for book: {$book->title}");
                }

            }

            $order->payment()->create([
                'payment_method' => $paymentMethod->type, // this will return 'card' or 'fpx'
                'transaction_id' => $paymentIntent->id,
                'amount' => $order->total_price,
                'status' => 'success',
                'paid_at' => now(),
            ]);

            $cart->items()->delete();
        });


        Mail::to($user->email)->send(new OrderPlacedMail($order));


        Alert::success('Payment Successful', 'Your order has been placed.');
        return redirect()->route('orders');
    }

    public function stripeCancel()
    {
        Alert::info('Payment Cancelled', 'You have cancelled the payment.');
        return redirect()->route('cart');
    }
}
