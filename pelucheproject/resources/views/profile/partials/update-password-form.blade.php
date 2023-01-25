<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Mettre à jour le mot de passe') }}
        </h2>

        <p class="mt-1 text-sm">
            {{ __('Assurez-vous d\'utiliser un mot de passe long et aléatoire pour rester sécurisé.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-control w-full max-w-xs">
            <label for="current_password" class="label">
              <span class="label-text">{{ __('Mot de passe actuel') }}</span>
            </label>
            <input id="current_password" name="current_password" type="password" class="input input-bordered w-full max-w-xs" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="form-control w-full max-w-xs">
            <label for="password" class="label">
              <span class="label-text">{{ __('Nouveau mot de passe') }}</span>
            </label>
            <input id="password" name="password" type="password" class="input input-bordered w-full max-w-xs" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="form-control w-full max-w-xs">
            <label for="password_confirmation" class="label">
              <span class="label-text">{{ __('Confirmer le nouveau mot de passe') }}</span>
            </label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="input input-bordered w-full max-w-xs" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button class="btn btn-primary">{{ __('Enregistrer') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm"
                >{{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>
