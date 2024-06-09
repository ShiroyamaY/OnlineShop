<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\SignInFormRequest;
use App\Http\Requests\Auth\SignUpFormRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        return redirect()->intended(route('home'));
    }
    public function forgotPassword():View{
        return view('auth.forgot-password');
    }
}
