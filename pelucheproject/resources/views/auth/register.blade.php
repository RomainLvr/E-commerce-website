<x-layout>
    <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-control w-full max-w-xs">
            <label class="label">
                <span class="label-text">{{ __('Nom') }}</span>
            </label>
            <input id="name" class="block input input-bordered w-full max-w-xs" type="text" name="name" value="{{old('name')}}" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="form-control w-full max-w-xs">
            <label class="label">
                <span class="label-text">{{ __('Email') }}</span>
            </label>
            <input id="email" class="block input input-bordered w-full max-w-xs" type="email" name="email" value="{{old('email')}}" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-control w-full max-w-xs">
            <label class="label">
                <span class="label-text">{{ __('Mot de passe') }}</span>
            </label>

            <input id="password" class="block input input-bordered w-full max-w-xs"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="form-control w-full max-w-xs">
            <label class="label">
                <span class="label-text">{{ __('Confirmer le mot de passe') }}</span>
            </label>

            <input id="password_confirmation" class="block input input-bordered w-full max-w-xs"
                            type="password"
                            name="password_confirmation" required />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center justify-end mt-4">

            <button class="btn btn-primary mb-4">
                {{ __('S\'inscrire') }}
            </button>

            <a class="text-sm link link-hover" href="{{ route('login') }}">
                {{ __('J\'ai déjà un compte') }}
            </a>
            
        </div>
    </form>
</x-guest-layout>
</x-layout>
