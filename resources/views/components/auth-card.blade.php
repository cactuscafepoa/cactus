<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        <!--{{ $logo }}-->
        <img src="{{ URL::asset('images/logo.png') }}" alt="Cactus Café Poa" width="118" height="118">
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
    <div class="w-full sm:max-w-md mt-6 px-6 py-1 bg-white shadow-md overflow-hidden sm:rounded-lg" style="text-align:center;">

        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Criar Usuário</a>
        @endif


    </div>
</div>
