<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Apprenant\DashboardController as ApprenantDashboard;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Redirection après connexion selon le rôle
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('apprenant.dashboard');
})->middleware(['auth'])->name('dashboard');

// =============================================
// ROUTES ADMIN
// =============================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        Route::resource('formations', \App\Http\Controllers\Admin\FormationController::class);
    });

// =============================================
// ROUTES APPRENANT
// =============================================
Route::middleware(['auth', 'role:apprenant'])
    ->prefix('apprenant')
    ->name('apprenant.')
    ->group(function () {

        Route::get('/dashboard', [ApprenantDashboard::class, 'index'])->name('dashboard');

        // Les autres routes apprenant viendront ici plus tard
    });

require __DIR__.'/auth.php';