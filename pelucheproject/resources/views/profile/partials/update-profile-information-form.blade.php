<section>
    <h2 class="text-lg font-medium">
        {{ __('Informations du profil') }}
    </h2>

    <p class="mt-1 text-sm">
        {{ __('Mettre à jour vos informations.') }}
    </p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-control w-full max-w-xs">
            <label for="name" class="label">
                <span class="label-text">{{ __('Nom') }}</span>
            </label>
            <input id="name" name="name" type="text" class="input input-bordered w-full max-w-xs"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="form-control w-full max-w-xs">
            <label for="email" class="label">
                <span class="label-text">{{ __('Email') }}</span>
            </label>
            <input id="email" name="email" type="email" class="input input-bordered w-full max-w-xs"
                value="{{ old('email', $user->email) }}" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2">
                        {{ __('Votre adresse mail n\'a pas été vérifiée.') }}

                        <button form="send-verification" class="btn btn-secondary">
                            {{ __('Cliquez ici pour renvoyer la vérification de votre adresse mail.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm">
                            {{ __('Un nouveau lien de vérification à été envoyé à votre adresse mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button class="btn btn-primary">{{ __('Enregistrer') }}</button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm">
                    {{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
    <form method="post" action="{{ route('profile.avatar') }}" class="mt-6 space-y-6">
        <div class="flex flex-col justify-center items-center">
            <div class="avatar">
                <div class="w-24 rounded-full">
                    <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}" alt="avatar">
                </div>
            </div>
            <input type="file" class="file-input file-input-bordered file-input-primary w-full max-w-xs" />
        </div>
    </form>
</section>
