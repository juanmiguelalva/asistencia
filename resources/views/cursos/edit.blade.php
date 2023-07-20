<x-splade-modal class="p-9">
    <h1>Editar - {{$curso->nombre}}</h1>
    <x-splade-form method="PUT" class="mt-3" action="{{route('cursos.update',$curso)}}" :default="$curso">
        <div class="flex flex-col space-y-7">
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
        </div>
    </x-splade-form>
</x-splade-modal>