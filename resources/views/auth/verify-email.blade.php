@extends('layouts.auth')
@section('title','Подтверждение email')
@section('content')
<x-forms.auth-forms title="Подтвердите ваш email"
                    method="POST"
                    action="{{route('verification.send')}}">
    @if(session('status'))
            <h3 class="font-medium text-md mb-1">{{session('status')}}</h3>
    @endif
    <x-forms.primary-button>Отправить ссылку для подтверждения почты</x-forms.primary-button>
</x-forms.auth-forms>
<form method="POST" action="{{route('logout')}}">
    @csrf
    @method('DELETE')
    <button class="border-[#A07BF0]" type="submit">Выйти из аккаунта</button>
</form>
@endsection
