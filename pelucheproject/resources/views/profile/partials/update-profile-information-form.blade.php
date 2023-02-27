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

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="flex flex-col md:flex-row justify-between">
            <div class="flex flex-col gap-4">
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
            </div>
            <div class="flex flex-col">
                <div class="flex flex-col items-center gap-y-3">
                    <label for="avatar" class="label">
                        <span class="label-text">{{ __('Avatar') }}</span>
                    </label>
                    <div class="avatar">
                        <div class="w-24 rounded-full">
                            @if (Auth::check() && Auth::user()->avatar != null)
                            <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}"
                                alt="avatar">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" class="stroke-neutral-content w-auto h-auto">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        @endif
                        </div>
                    </div>
                    <input type="file" name="avatar"
                        class="file-input file-input-bordered file-input-xs file-input-primary w-full max-w-xs" accept=".png, .jpg, .jpeg" />
                </div>
            </div>
        </div>

        @isset($path)
            {{ $path }}
        @endisset
            

        <div class="flex items-center gap-4">
            <button class="btn btn-primary">{{ __('Enregistrer') }}</button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm">
                    {{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>
