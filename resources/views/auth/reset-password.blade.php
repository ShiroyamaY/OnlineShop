@extends('layouts.auth')
@section('title','Забыли пароль')
@section('content')
<x-forms.auth-forms title="Забыли пароль"
                    method="POST"
                    action="{{route('password.update')}}">

    <x-forms.text-input
        name="token"
        type="text"
        value="{{$token}}"
        hidden
    />
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

    <x-forms.text-input
        name="password"
        type="password"
        placeholder="Пароль"
        required
        :isError="$errors->has('password')"
    />
    @error('password')
    <x-forms.errors>
        {{$message}}
    </x-forms.errors>
    @enderror

    <x-forms.text-input
        name="password_confirmation"
        type="password"
        placeholder="Подтверждение пароля"
        required
        :isError="$errors->has('password_confirmation')"
    />
    @error('password_confirmation')
    <x-forms.errors>
        {{$message}}
    </x-forms.errors>
    @enderror
    <x-forms.primary-button>Обновить пароль</x-forms.primary-button>
</x-forms.auth-forms>
@endsection
