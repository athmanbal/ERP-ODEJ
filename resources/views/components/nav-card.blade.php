<div class="col-span-12 sm:col-span-4
    {{ $highlight ? 'font-bold' : '' }}
    bg-blue-200 hover:bg-blue-300 hover:shadow-xl
    border-l-2 border-blue-400 m-2 p-3 flex items-center justify-center text-center
    relative rounded-lg transition">

    <a class="flex items-center gap-3 w-full justify-center" href="{{ route($route) }}">
        {{-- Icône --}}
        <div class="text-violet-500">
            {!! $icon !!}
        </div>

        {{-- Titre --}}
        <div class="text-xl md:text-2xl font-semibold text-gray-800 dark:text-gray-100 uppercase">
            {{ $title }}
        </div>
    </a>

    {{-- Coins décoratifs --}}
    <div class="absolute top-0 right-0 w-0 h-0 border-transparent border-t-gray-100 border-r-gray-100"
        style="border-width: 14px;"></div>
    <div class="absolute bottom-0 right-0 w-0 h-0 border-transparent border-b-gray-100 border-r-gray-100"
        style="border-width: 14px;"></div>
</div>
