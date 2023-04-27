<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeginController;
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

//Admin Login
 Route::get('/auth/admin', function () {
        return view('admin-login');
    })->name('admin.login');
 Route::post('/auth/admin/login', [AuthController::class, 'login']);
 Route::post('/auth/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

//Admin CRUD
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin', [QuestionController::class, 'index'])->name('admin');
    Route::post('/admin', [QuestionController::class, 'create'])->name('admin.store');
    Route::put('/admin', [QuestionController::class, 'update'])->name('admin.update');
    Route::delete('/admin', [QuestionController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin-result', [ResultController::class, 'index'])->name('admin-result');
    Route::put('/admin-result', [ResultController::class, 'update'])->name('admin-result.update');
    Route::delete('/admin-result', [ResultController::class, 'destroy'])->name('admin-result.destroy');
});

//Usability Testing Routes
Route::get('/', function () {
    return view('begin');
});
Route::post('/', [BeginController::class, 'store']);
Route::get('/questions/{questionIndex}', [QuestionController::class, 'show'])->name('questions.show');
Route::post('/questions/{questionIndex}', [QuestionController::class, 'store'])->name('questions.store');
Route::get('/result', [ResultController::class, 'show'])->name('result.show');

