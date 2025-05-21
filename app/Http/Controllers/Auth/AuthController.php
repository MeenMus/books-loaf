<?php

namespace App\Http\Controllers\Auth;

use App\Models\Profile;
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
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

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

        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'customer', // or any default role
            ]);

            Profile::create([
                'user_id' => $user->id,
            ]);


            // Send email verification
            event(new Registered($user));

            Alert::success('Registration successful', 'Please verify your email before logging in');
            return redirect()->back();
        } catch (ValidationException $e) {

            Alert::error('Submission Error', $e->validator->errors()->first());
            return redirect()->back();
        }
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


    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        return $this->loginOrRegister($user);
    }

    // Facebook Login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        return $this->loginOrRegister($user);
    }

    private function loginOrRegister($socialUser)
    {
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(Str::random(24)),
                'role' => 'customer', // or any default role
                'email_verified_at' => now(),
            ]);

            Profile::create([
                'user_id' => $user->id,
            ]);
        }

        Auth::login($user, true);

        return redirect('/');
    }
}
