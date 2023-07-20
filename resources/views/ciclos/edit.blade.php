<x-splade-modal>
    <h1>Editar - {{$ciclo->nombre}}</h1>
    <x-splade-form method="PUT" class="mt-3" action="{{route('ciclos.update',$ciclo)}}" :default="$ciclo">
        <x-splade-input name="nombre" label="Nombre" />
        <x-splade-submit class="mt-5">
                Guardar
        </x-splade-submit>
    </x-splade-form>
</x-splade-modal>