<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div>
        <h1 class="text-5xl text-center">
            @if (Route::currentRouteName() == 'login')
                {{ __('Connexion') }}
            @elseif (Route::currentRouteName() == 'register')
                {{ __('Inscription') }}
            @endif
        </h1>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-base-200 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
