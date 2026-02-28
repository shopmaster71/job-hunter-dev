<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function register(): View
    {
        return view('user.register');
    }

    /**
     * Handle an incoming registration request.
     * @param UserRegistrationRequest $request
     * @return void
     */
    public function registerPost(UserRegistrationRequest $request):RedirectResponse
    {
        $validated = $request->validated();
        $user = User::create($validated);
        event(new Registered($user));
        Auth::login($user);
        //return redirect()->route('verification.notice');
        return redirect('login')->with('success', 'Регистрация прошла успешно!');
    }

    /**
     * Display the login view.
     */
    public function login(): View
    {
        return view('user.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function loginPost(UserLoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended('/')->with('success', 'Добро пожаловать!');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    /**
     * Display the password reset link request view.
     */
    public function forgot(): View
    {
        return view('user.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function forgotPost(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status == Password::RESET_LINK_SENT
            ? back()->with('success', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }

    /**
     * Display the password reset view.
     */
    public function reset(Request $request): View
    {
        return view('user.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function resetPost(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }

    /**
     * Display the email verification prompt.
     */
    public function verifiedEmail(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(route('home', absolute: false))
            : view('user.verify-email');
    }

    /**
     * Mark the authenticated user's email address as verified.
     */
    public function verifiedEmailRequest(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('home', absolute: false).'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('home', absolute: false).'?verified=1');
    }

    /**
     * Send a new email verification notification.
     */
    public function verifiedEmailPost(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('home', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Email подтверждён!');
    }
}
