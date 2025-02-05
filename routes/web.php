<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FashionController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualandetailController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('fashion', FashionController::class);
Route::resource('penjualan', PenjualanController::class);
Route::get('/fashion-printpdf', [PdfController::class, 'fashionpdf'])->name('fashion.printpdf');

Route::get('penjualandetail/{id}/create', [PenjualandetailController::class, 'create'])->name('penjualandetail.create');


Route::post('penjualandetail', [PenjualandetailController::class, 'store'])->name('penjualandetail.store');


Route::get('penjualandetail/{id}/list', [PenjualandetailController::class, 'list'])->name('penjualandetail.list');


Route::delete('penjualandetail/{detail_id}/delete/{penjualan_id}', [PenjualandetailController::class, 'destroy'])->name('penjualandetail.destroy');


Route::get('penjualandetail/{id}/lunas', [PenjualandetailController::class, 'setLunas'])->name('penjualandetail.lunas');


Route::get('/search-fashion', [FashionController::class, 'search'])->name('search.fashion');

Route::get('penjualandetail/{id}/lunas', [PenjualandetailController::class, 'setLunas'])->name('penjualandetail.lunas');
//Route::get('dosen/printpdf', [DosenController::class, 'printpdf'])->name('dosen.printpdf');




Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'loginIndex']);
    Route::get('register', [AuthController::class, 'registerIndex']);

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [WelcomeController::class, 'index']);
    Route::get('logout', [AuthController::class, 'logout']);
});