<x-splade-modal action="{{route('ciclos.store')}}">
    <h1>Agregar nuevo ciclo </h1>
    <x-splade-form class="mt-3">
        <x-splade-input name="nombre" label="Nombre" />
        <x-splade-submit class="mt-5">
                Guardar
        </x-splade-submit>
    </x-splade-form>
</x-splade-modal>