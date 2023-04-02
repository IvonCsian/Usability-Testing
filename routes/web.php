<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IntroController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/intro', [IntroController::class, 'show']);
Route::post('/intro', [IntroController::class, 'store']);
Route::get('/questions/{questionIndex}', [QuestionController::class, 'show'])->name('questions.show');
Route::post('/questions/{questionIndex}', [QuestionController::class, 'store'])->name('questions.store');
Route::get('/outro', [OutroController::class, 'show']);

