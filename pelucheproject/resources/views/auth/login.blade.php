<x-layout>
    <x-guest-layout>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="flex flex-col justify-center">
            @csrf

            <!-- Email Address -->
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">{{ __('Email') }}</span>
                </label>
                <input id="email" class="block input input-bordered w-full max-w-xs" type="email" name="email"
                    :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">{{ __('Password') }}</span>
                </label>

                <input id="password" class="block mt-1 input input-bordered w-full max-w-xs" type="password"
                    name="password" required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="form-control">
                <label for="remember_me" class="mt-4 cursor-pointer">
                    <span class="label-text">{{ __('Remember me') }}</span>
                    <input id="remember_me" type="checkbox" class="checkbox checkbox-success" name="remember">
                </label>
            </div>

            <div class="flex flex-col items-center justify-end mt-4">

                <button class="mb-4 btn btn-primary">
                    {{ __('Se connecter') }}
                <button>

                @if (Route::has('password.request'))
                    <a class="text-sm link link-hover" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?') }}
                    </a>
                @endif
            </div>
        </form>
    </x-guest-layout>
</x-layout>
