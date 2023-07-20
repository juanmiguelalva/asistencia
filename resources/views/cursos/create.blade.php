<x-splade-modal class="p-9" action="{{route('cursos.store')}}">
    <h1>Agregar nuevo curso </h1>
    <x-splade-form class="mt-3">
        <x-splade-input name="codigo" label="Código" />
        <x-splade-input name="nombre" label="Nombre" />
        <x-splade-select name="ciclo_id" label="Ciclo">
            <option value="" selected disabled>Selecciona</option>
            @foreach($ciclos as $ciclo)
                <option value="{{$ciclo->id}}">{{$ciclo->nombre}}</option>
            @endforeach
        </x-splade-select>
        <x-splade-select name="escuela" label="Escuela">
            <option value="MH">Medicina Humana</option>
            <option value="EN">Enfermería</option>
        </x-splade-select>
        <x-splade-submit class="mt-5">
                Guardar
        </x-splade-submit>
    </x-splade-form>
</x-splade-modal>