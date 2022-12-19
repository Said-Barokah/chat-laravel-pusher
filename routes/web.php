<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChatsController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/chat', [ChatsController::class, 'index'])->name('chat');
    // Route::get('/messages', [ChatsController::class, 'fetchMessages'])->name('fetch.messages');
    Route::post('/messages', [ChatsController::class, 'sendMessage'])->name('send.message');
    Route::get('/messages/{idPsychologist}',[ChatsController::class, 'indexMessage'])->name('index.messages');
    Route::get('/fetch/message/{idPsychologist}',[ChatsController::class, 'fetchMessages'])->name('fetch.messages');


});



