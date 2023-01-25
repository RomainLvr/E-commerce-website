<section class="space-y-6">

    <h2 class="text-lg font-medium">
        {{ __('Supprimer le compte') }}
    </h2>

    <p class="mt-1 text-sm">
        {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.') }}
    </p>

    <button class="btn btn-error" x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Supprimer le compte') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium mb-5">
                {{ __('Etes-vous sûre de vouloir supprimer votre compte ?') }}
            </h2>

            <p class="mt-1 text-sm">
                {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Veuillez entrer votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.') }}
            </p>

            <div class="form-control w-full max-w-xs">
                
                <input id="password" name="password" type="password" class="input input-bordered w-full max-w-xs m-4"
                    placeholder="Password" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <button class="btn btn-info mr-4" x-on:click="$dispatch('close')">
                    {{ __('Annuler') }}
                <button>

                <button class="btn btn-error">
                    {{ __('Supprimer le compte') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
