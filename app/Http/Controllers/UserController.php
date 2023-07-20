<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Tables\Users;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('user_access');
        return view('users.index', [
            'users' => Users::class,
        ]);
    }
    public function create()
    {
        $this->authorize('user_access');
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->authorize('user_access');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required', 'int'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->roles()->attach($request->role);

        Toast::title('Operación exitosa')
            ->message('Nuevo usuario agregado')
            ->rightBottom()
            ->autoDismiss(10);
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $this->authorize('user_access');
        $roles = Role::all();
        // dd($user->roles()->first()->id);
        $id_role = null;
        if ($user->roles()->first()) {
            $id_role = $user->roles()->first()->id;
        }

        if ($id_role != null) {
            return view('users.edit', compact('user', 'roles', 'id_role'));
        } else {
            return view('users.edit', compact('user', 'roles'));
        }
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('user_access');
        // dd($request->role[0]);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'password' => ['nullable', Rules\Password::defaults()],
            'role.*' => ['required', 'int'],
        ]);

        $data = [
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        $user->roles()->sync([$request->role[0]]);

        Toast::title('Operación exitosa')
            ->message('Usuario actualizado')
            ->rightBottom()
            ->autoDismiss(10);
        // return redirect()->route('users.index');
        return redirect()->back();
    }

    public function destroy(User $user)
    {
        $this->authorize('user_access');
        if ($old = $user->avatar) {
            Storage::disk('public')->delete(str_replace('storage/', '', $old));
        }
        $user->delete();
        Toast::title('Operación exitosa')
            ->info()
            ->message('El usuario ha sido eliminado')
            ->rightBottom()
            ->autoDismiss(10);
        return redirect()->route('users.index');
    }
}
