<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;


Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::middleware('auth')->group(function () {
        // Route::get('/dashboard', function () {
        //     return view('dashboard');
        // })->middleware(['verified'])->name('dashboard');

        Route::get('/inicio', function () {
            if (Auth::user()->role[0]->id == 1) {
                return redirect('reporte');
            } else {
                return redirect('mis_clases');
            }
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/avatar', [ProfileController::class, 'avatar'])->name('profile.avatar');
        Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


        Route::resource('reporte', \App\Http\Controllers\ReporteController::class);

        Route::resource('ciclos', \App\Http\Controllers\CicloController::class);
        Route::resource('cursos', \App\Http\Controllers\CursoController::class);
        Route::resource('clases', \App\Http\Controllers\ClaseController::class);

        Route::resource('roles', \App\Http\Controllers\RoleController::class);
        Route::resource('users', \App\Http\Controllers\UserController::class);
        Route::resource('mis_clases', \App\Http\Controllers\MisClasesController::class);
    });

    require __DIR__ . '/auth.php';
});
