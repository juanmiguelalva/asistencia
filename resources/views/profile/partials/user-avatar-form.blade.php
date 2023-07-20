<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Foto del Usuario') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Actualiza la foto de tu cuenta.") }}
        </p>
    </header>

    <x-splade-form method="patch" :action="route('profile.avatar')" :default="$user" class="mt-6 space-y-6" preserve-scroll>
        <x-splade-file name="avatar" filepond min-size="10KB" max-size="2MB" preview accept="image/*"/>

        <div class="flex items-center gap-4">
            <x-splade-submit :label="__('Guardar')" />

            @if (session('status') === 'avatar-updated')
                <p class="text-sm text-gray-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </x-splade-form>
</section>
