<x-splade-modal>
    <h1>Agregar nuevo rol </h1>
    <x-splade-form class="mt-3" action="{{route('roles.store')}}">
        <div class="flex flex-col space-y-7">
            <x-splade-input name="title" label="Nombre" />
            <x-splade-select name="permissions[]" label="Permisos" placeholder="Seleccione" multiple choices>
                @foreach($permissions as $permission)
                    <option value="{{$permission->id}}">{{$permission->title}}</option>
                @endforeach
            </x-splade-select>

            <x-splade-submit class="mt-5" :spinner="true">
                    Guardar
            </x-splade-submit>
        </div>
    </x-splade-form>
</x-splade-modal>