@extends('layouts.app')
@section('content')
    @auth
        <form method="POST" action="{{route('logout')}}">
            @csrf
            @method('DELETE')
            <button class="border-[#A07BF0] bg-amber-700" type="submit">Выйти из аккаунта</button>
        </form>
    @endauth
    @guest
        <div class="space-y-3 mt-5">
            <div class="text-xxs md:text-xs"><a href="{{route('login')}}" class="text-white hover:text-white/70 font-bold">Войти в аккаунт</a></div>
            <div class="text-xxs md:text-xs"><a href="{{route('sign-up')}}" class="text-white hover:text-white/70 font-bold">Регистрация</a></div>
        </div>
    @endguest
@endsection
