<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\PsychologistController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PsychologistChatsController;
use App\Http\Controllers\PaymentController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', [HomeController::class,'index'])->name('home');
Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'),'verified',])->group(function () {

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/dashboard/history-payment',[DashboardController::class,'historyPayment'])->name('history.payment');
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


Route::get('/fetch/psychologists/',[DashboardController::class,'indexPsychologist'])->name('psychologist.index');
Route::get('/fetch/packages/{idPsychologist}',[DashboardController::class,'indexPackages'])->name('package.index');

Route::get('/payment/history/',[PaymentController::class,'index'])->name('payment.index');
Route::get('/payment/package/{packageId}',[PaymentController::class,'getToken'])->name('snap.payment');
Route::post('/payment/package/{packageId}',[PaymentController::class,'store'])->name('payment');