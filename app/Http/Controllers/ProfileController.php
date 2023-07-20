<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\Splade\Facades\Toast;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        Toast::title('Operación exitosa')
            ->message('Tu perfil se ha actualizado')
            ->rightBottom()
            ->autoDismiss(10);
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function avatar(Request $request)
    {
        $request->validate([
            'avatar' => 'file|nullable',
        ]);

        if ($old = $request->user()->avatar) {
            Storage::disk('public')->delete(str_replace('storage/', '', $old));
            auth()->user()->update(['avatar' => ""]);
        }

        if ($request->file('avatar') != null) {
            $name = $request->file('avatar')->hashName();
            Storage::put("public/avatars", $request->file('avatar'));
            auth()->user()->update(['avatar' => "storage/avatars/$name"]);
        }

        Toast::title('Operación exitosa')
            ->message('Tu foto se ha actualizado')
            ->rightBottom()
            ->autoDismiss(10);
        return Redirect::route('profile.edit')->with('status', 'avatar-updated');
    }
}
