<form class="space-y-3" method="{{$method}}" action="{{$action}}">
    @csrf
    {{$slot}}
</form>

{{$socialAuth}}

{{$buttons}}

<ul class="flex flex-col md:flex-row justify-between gap-3 md:gap-4 mt-14 md:mt-20">
    <li>
        <a href="#" class="inline-block text-white hover:text-white/70 text-xxs md:text-xs font-medium" target="_blank" rel="noopener">Пользовательское соглашение</a>
    </li>
    <li class="hidden md:block">
        <div class="h-full w-[2px] bg-white/20"></div>
    </li>
    <li>
        <a href="#" class="inline-block text-white hover:text-white/70 text-xxs md:text-xs font-medium" target="_blank" rel="noopener">Политика конфиденциальности</a>
    </li>
</ul>
