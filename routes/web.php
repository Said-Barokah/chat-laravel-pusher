<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\PsychologistController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\PsychologistChatsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'),'verified',])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/chat', [ChatsController::class, 'index'])->name('chat');
    Route::post('/messages', [ChatsController::class, 'sendMessage'])->name('send.message');
    Route::get('/messages/{idPsychologist}',[ChatsController::class, 'indexMessage'])->name('index.messages');
    Route::get('/fetch/message/{idPsychologist}',[ChatsController::class, 'fetchMessages'])->name('fetch.messages');

});

Route::get('/dashboard-psychologist',[PsychologistController::class, 'dashboard'])->name('psychologist.dashboard');

Route::get('/login-psychologist',[AuthenticatedSessionController::class,'createPsychologist'])->name('psychologist.login');
Route::post('/login-psychologist',[AuthenticatedSessionController::class,'storePsychologist'])->name('psychologist.login');
Route::post('/logout-psychologist',[AuthenticatedSessionController::class,'destroyPsychologist'])->name('psychologist.logout');

Route::get('/chat-psychologist', [PsychologistChatsController::class, 'index'])->name('psychologist.chat');
Route::post('/messages-psychologist', [PsychologistChatsController::class, 'sendMessage'])->name('psychologist.send.message');
Route::get('/messages-psychologist/{idClient}',[PsychologistChatsController::class, 'indexMessage'])->name('psychologist.index.messages')->middleware('auth:psychologist');
Route::get('/fetch-psychologist/message/{idClient}',[PsychologistChatsController::class, 'fetchMessages'])->name('psychologist.fetch.messages')->middleware('auth:psychologist');
