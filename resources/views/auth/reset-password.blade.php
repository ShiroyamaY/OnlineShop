@extends('layouts.auth')
@section('title','Забыли пароль')
@section('content')
<x-forms.auth-forms title="Забыли пароль"
                    method="POST"
                    action="#">
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
    <x-forms.primary-button>Обновить пароль</x-forms.primary-button>
</x-forms.auth-forms>
@endsection
