<x-splade-modal class="p-9" action="{{route('clases.store')}}">
    <h1>Agregar nueva clase </h1>
    <x-splade-form class="mt-3">
        <div class="flex flex-col space-y-7">
            <x-splade-input name="dia" label="Día" />
            <x-splade-input name="hora_inicio" label="Hora de Inicio" time/>
            <x-splade-input name="hora_fin" label="Hora de Fin" time/>
            <x-splade-select name="user_id" label="Docente" choices="{ searchEnabled: true }">
                <option value="" selected disabled>Selecciona</option>
                @foreach($users as $user)
                    @if($user->role[0]->id!=1)
                    <option value="{{$user->id}}">{{$user->name}} {{$user->lastname}}</option>
                    @endif
                @endforeach
            </x-splade-select>
            <x-splade-select name="curso_id" label="Curso" choices="{ searchEnabled: true }">
                <option value="" selected disabled>Selecciona</option>
                @foreach($cursos as $curso)
                    <option value="{{$curso->id}}">{{$curso->nombre}}</option>
                @endforeach
            </x-splade-select>
            <x-splade-submit class="mt-5">
                    Guardar
            </x-splade-submit>
        </div>
    </x-splade-form>
</x-splade-modal>