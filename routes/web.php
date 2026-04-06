<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Apprenant\DashboardController as ApprenantDashboard;

Route::get('/', function () {
    return view('welcome');
});

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
        Route::resource('chapitres', \App\Http\Controllers\Admin\ChapitreController::class);
        Route::resource('sous-chapitres', \App\Http\Controllers\Admin\SousChapitreController::class);
        Route::resource('apprenants', \App\Http\Controllers\Admin\ApprenantController::class);
        Route::resource('quiz', \App\Http\Controllers\Admin\QuizController::class);
        Route::resource('notes', \App\Http\Controllers\Admin\NoteController::class)->except(['show']);

        Route::get('/apprenants/{apprenant}/enrollments', [\App\Http\Controllers\Admin\ApprenantController::class, 'enrollments'])->name('apprenants.enrollments');
        Route::put('/apprenants/{apprenant}/enrollments', [\App\Http\Controllers\Admin\ApprenantController::class, 'updateEnrollments'])->name('apprenants.updateEnrollments');

        Route::get('/quiz/{quiz}/questions/create', [\App\Http\Controllers\Admin\QuestionController::class, 'create'])->name('questions.create');
        Route::post('/quiz/{quiz}/questions', [\App\Http\Controllers\Admin\QuestionController::class, 'store'])->name('questions.store');
        Route::get('/questions/{question}/edit', [\App\Http\Controllers\Admin\QuestionController::class, 'edit'])->name('questions.edit');
        Route::put('/questions/{question}', [\App\Http\Controllers\Admin\QuestionController::class, 'update'])->name('questions.update');
        Route::delete('/questions/{question}', [\App\Http\Controllers\Admin\QuestionController::class, 'destroy'])->name('questions.destroy');



        // Routes import contenu IA
        Route::get('/sous-chapitres/{sousChapitre}/import', [\App\Http\Controllers\Admin\ImportController::class, 'show'])->name('import.show');
        Route::post('/sous-chapitres/{sousChapitre}/import', [\App\Http\Controllers\Admin\ImportController::class, 'store'])->name('import.store');
        // Routes import quiz IA
        Route::get('/sous-chapitres/{sousChapitre}/import-quiz', [\App\Http\Controllers\Admin\ImportController::class, 'showQuiz'])->name('import.quiz');
        Route::post('/sous-chapitres/{sousChapitre}/import-quiz', [\App\Http\Controllers\Admin\ImportController::class, 'storeQuiz'])->name('import.storeQuiz');
    });

// =============================================
// ROUTES APPRENANT
// =============================================
Route::middleware(['auth', 'role:apprenant'])
    ->prefix('apprenant')
    ->name('apprenant.')
    ->group(function () {

        Route::get('/dashboard', [ApprenantDashboard::class, 'index'])->name('dashboard');

        Route::get('/formations', [\App\Http\Controllers\Apprenant\FormationController::class, 'index'])->name('formations.index');
        Route::get('/formations/{id}', [\App\Http\Controllers\Apprenant\FormationController::class, 'show'])->name('formations.show');

        Route::get('/sous-chapitres/{sousChapitre}', [\App\Http\Controllers\Apprenant\SousChapitreController::class, 'show'])->name('sous-chapitres.show');

        Route::get('/quiz/{quiz}', [\App\Http\Controllers\Apprenant\QuizController::class, 'show'])->name('quiz.show');
        Route::post('/quiz/{quiz}/submit', [\App\Http\Controllers\Apprenant\QuizController::class, 'submit'])->name('quiz.submit');

        Route::get('/notes', [\App\Http\Controllers\Apprenant\NoteController::class, 'index'])->name('notes.index');
    });

require __DIR__.'/auth.php';