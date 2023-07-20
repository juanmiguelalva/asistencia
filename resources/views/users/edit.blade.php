<x-splade-modal class="p-9">
    <h1>Editar usuario {{$user->name}}</h1>
    <x-splade-form class="mt-3" action="{{route('users.update',$user)}}" :default="$user" method="PUT" preserve-scroll>
        <div class="flex flex-col space-y-7">
            <x-splade-input name="name" label="Nombres" autofocus/>
            <x-splade-input name="lastname" label="Apellidos"/>
            <x-splade-input name="email" type="email" label="Email" />
            <x-splade-input name="password" type="password" label="Contraseña" autocomplete="new-password"/>
            <x-splade-select name="role" label="Rol" placeholder="Seleccione" choices relation>
                <option value="" selected disabled>Seleccione</option>
                @foreach($roles as $role)
                    @if($role->id!=1)
                    <option value="{{$role->id}}">{{$role->title}}</option>
                    @endif
                @endforeach
            </x-splade-select>

            <x-splade-submit class="mt-5" :spinner="true">
                    Guardar
            </x-splade-submit>
        </div>
    </x-splade-form>
</x-splade-modal>