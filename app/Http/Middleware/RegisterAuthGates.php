<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RegisterAuthGates
{

    public function handle(Request $request, Closure $next)
    {
        $user = $request?->user()?->loadMissing('roles.permissions');

        if ($user) {
            foreach ($user->roles as $role) {
                foreach ($role->permissions as $singlePermission) {
                    $permission[] = $singlePermission->title;
                }
            }
            // dd($permission);
            collect($permission)->unique()->each(function ($permission) {
                Gate::define(
                    $permission,
                    function ($user) {
                        return true;
                    }
                );
            });
        }

        return $next($request);
    }
}
