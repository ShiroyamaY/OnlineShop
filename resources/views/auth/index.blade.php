@extends('layouts.auth')
@section('title','Вход в аккаунт')
@section('content')
<x-forms.auth-forms title="Вход в аккаунт"
                    method="POST"
                    action="{{route('sign-in')}}">
    @if(session('status'))
        <div class="alert-info">
            {{session('status')}}
        </div>
    @endif
    <x-forms.text-input
        name="email"
        type="email"
        placeholder="E-mail"
        required
        :isError="$errors->has('email')"
        value="{{old('email')}}"
    />
    @error('email')
        <x-forms.errors>
            {{$message}}
        </x-forms.errors>
    @enderror
    <x-forms.text-input
        name="password"
        type="password"
        placeholder="Пароль"
        required
    />
    <x-forms.primary-button>Войти</x-forms.primary-button>
    <x-slot:socialAuth>
        <div class="mt-5">
            <a href="{{route('google.auth')}}" class="relative flex items-center h-14 px-12 rounded-lg border border-[#A07BF0] bg-white/20 hover:bg-white/20 active:bg-white/10 active:translate-y-0.5">
                <svg class="shrink-0 absolute left-4 w-5 sm:w-6 h-5 sm:h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" height="24"  width="24">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    <path d="M1 1h22v22H1z" fill="none"/>
                </svg>
                <span class="grow text-xxs md:text-xs font-bold text-center">Google</span>
            </a>
        </div>
    </x-slot:socialAuth>
    <x-slot:buttons>
        <div class="space-y-3 mt-5">
            <div class="text-xxs md:text-xs"><a href="{{route('password.request')}}" class="text-white hover:text-white/70 font-bold">Забыли пароль?</a></div>
            <div class="text-xxs md:text-xs"><a href="{{route('sign-up')}}" class="text-white hover:text-white/70 font-bold">Регистрация</a></div>
        </div>
    </x-slot:buttons>
</x-forms.auth-forms>
@endsection
