<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', env('APP_NAME'))</title>

    @vite(['resources/css/app.css', 'resources/sass/main.sass', 'resources/js/app.js'])

    @section("styles")
    @show
    @section("scripts")
    @show

</head>
<body>
<main class="py-16 lg:py-20">
    <div class="container">
        <div class="text-center">
            <a href="{{route('home')}}" class="inline-block" rel="home">
                <img src="{{Vite::image('logo.svg')}}" class="w-[148px] md:w-[201px] h-[36px] md:h-[50px]" alt="CutCode">
            </a>
        </div>
    </div>
</main>
@yield('content')
</body>
</html>
