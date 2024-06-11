@extends('layouts.auth')
@section('title','Забыли пароль')
@section('content')
<x-forms.auth-forms title="Забыли пароль"
                    method="POST"
                    action="{{route('password.email')}}">
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
    />
    @error('email')
    <x-forms.errors>
        {{$message}}
    </x-forms.errors>
    @enderror
    <x-forms.primary-button>Отправить</x-forms.primary-button>
    <x-slot:buttons>
        <div class="space-y-3 mt-5">
            <div class="text-xxs md:text-xs"><a href="{{route('login')}}" class="text-white hover:text-white/70 font-bold">Вспомнил пароль</a></div>
            <div class="text-xxs md:text-xs"><a href="{{route('sign-up')}}" class="text-white hover:text-white/70 font-bold">Регистрация</a></div>
        </div>
    </x-slot:buttons>
</x-forms.auth-forms>
@endsection
