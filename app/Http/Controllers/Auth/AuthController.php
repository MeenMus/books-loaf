<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;



class AuthController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            Alert::error('Invalid Credentials', 'Email has already been registered!');
            return redirect()->back();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer', // or any default role
        ]);

        // Send email verification
        event(new Registered($user));

        Alert::success('Registration successful', 'Please verify your email before logging in');
        return redirect()->back();
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            Alert::error('Invalid Credentials', 'Please re-enter your credentials');
            return redirect()->back();
        }

        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();

            Alert::warning('Email not verified', 'A new verification link has been sent to your email.');
            return redirect()->back();
        }

        Auth::login($user);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/');
    }
    

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            Alert::success('Email Sent', 'A new password reset link has been sent to your email.');
            return redirect('login');
        } else {
            Alert::error('Error!', __($status));
            return redirect()->back()->withErrors(['email' => __($status)]);
        }

    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            Alert::success('Password Reset!', 'Your password has been changed!');
            return redirect('login');
        } else {
            Alert::error('Error!', __($status));
            return redirect()->back()->withErrors(['email' => __($status)]);
        }
    }


    public function verifyEmail(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (! URL::hasValidSignature($request)) {
            Alert::error('Verification Expired', 'Invalid or expired verification link.');
            return redirect('login');
        }

        if (! hash_equals(sha1($user->getEmailForVerification()), $hash)) {
            Alert::error('Verification Error', 'Invalid verification hash.');
            return redirect('login');
        }

        if ($user->hasVerifiedEmail()) {
            Alert::error('Email Verified', 'Email has already been verified.');
            return redirect('login');
        }

        $user->markEmailAsVerified();
        event(new Verified($user));

        Alert::success('Email Verified!', 'Email verified successfully!');
        return redirect('login');
    }

    public function resendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            Alert::error('Email Verified', 'Email has already been verified.');
            return redirect('login');
        }

        $request->user()->sendEmailVerificationNotification();

        Alert::success('Email Sent!', 'Verification email sent!');
        return redirect('login');
    }
}
