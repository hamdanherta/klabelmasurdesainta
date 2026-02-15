<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::get('/test-log', function () {
    Log::info('Test log entry');
    return 'Log written';
});

use App\Http\Controllers\QuestionnaireController;

Route::get('/', [QuestionnaireController::class , 'welcome'])->name('welcome');
Route::get('/tutorial', [QuestionnaireController::class , 'tutorial'])->name('tutorial');
Route::get('/ready', [QuestionnaireController::class , 'ready'])->name('ready');
Route::get('/identity', [QuestionnaireController::class , 'identity'])->name('identity');
Route::post('/identity', [QuestionnaireController::class , 'storeIdentity'])->name('identity.store');
Route::get('/questionnaire', [QuestionnaireController::class , 'index'])->name('questionnaire.index');
Route::post('/questionnaire', [QuestionnaireController::class , 'store'])->name('questionnaire.store');
Route::get('/thank-you', [QuestionnaireController::class , 'thankyou'])->name('thankyou');

// Admin Routes
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('login');

Route::post('/admin/login', [\App\Http\Controllers\AdminController::class , 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [\App\Http\Controllers\AdminController::class , 'logout'])->name('admin.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class , 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/download', [\App\Http\Controllers\AdminController::class , 'downloadCsv'])->name('admin.download');
    Route::post('/admin/reset', [\App\Http\Controllers\AdminController::class , 'resetCsv'])->name('admin.reset');
});
