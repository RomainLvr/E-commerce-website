<x-layout>
    <x-guest-layout>

        <h2 class="text-lg font-medium mb-6">
            {{ __('Mot de passe oublié') }}
        </h2>


        <div class="mb-4 text-sm">
            {{ __('Mot de passe oublié ? Pas de problème. Indiquez-nous simplement votre adresse email et nous vous enverrons un lien de réinitialisation de mot de passe qui vous permettra de choisir un nouveau mot de passe.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">{{ __('Email') }}</span>
                </label>
                <input id="email" class="block input input-bordered w-full max-w-xs" type="email" name="email" value="{{old('email')}}"
                    required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-primary">
                    {{ __('Envoyer') }}
                </button>
            </div>
        </form>
    </x-guest-layout>
</x-layout>
