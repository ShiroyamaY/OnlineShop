<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ForgotPasswordFormRequest;
use App\Http\Requests\Auth\ResetPasswordFormRequest;
use App\Http\Requests\Auth\SignInFormRequest;
use App\Http\Requests\Auth\SignUpFormRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function index(): View{
        return view('auth.index');
    }
    public function signIn(SignInFormRequest $request): RedirectResponse
    {
        if(!Auth::attempt($request->validated())){
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()
            ->intended(route('home'));
    }
    public function logOut(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('home');
    }
    public function signUp(): View
    {
        return view('auth.sign-up');
    }
    public function store(SignUpFormRequest $request): RedirectResponse
    {

        $user = User::query()->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        Auth::login($user);

        event(new Registered($user));

        return redirect()->intended(route('home'));
    }

    public function forgot(): View{

        return view('auth.forgot-password');
    }

    public function forgotPassword(ForgotPasswordFormRequest $request): RedirectResponse{
        $status = Password::sendResetLink(
            $request->safe()->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
    public function reset(Request $request): View{
        $token = $request->get('token');
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(ResetPasswordFormRequest $request): RedirectResponse{
            $status = Password::reset(
                $request->safe()->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => bcrypt($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
    }
}
