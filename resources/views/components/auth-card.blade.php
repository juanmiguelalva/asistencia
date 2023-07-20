<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        @isset($logo)
            {{ $logo }}
        @else
            <Link href="/" class="object-center">
                <x-application-logo class="w-28 h-28 fill-current text-gray-500" />
            </Link>
        @endisset
    </div>
    <h1 class="font-semibold text-center text-2xl pt-6 pb-1">Facultad Medicina Humana</h1>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
