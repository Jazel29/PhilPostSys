<?php

use App\Http\Controllers\BarCodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TracerController;
use App\Http\Controllers\AddTransmittalController;
use App\Http\Controllers\TransmittalsController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeUnit\FunctionUnit;

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
    return view('index');
});
Route::get('/hellowirld', function(){
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/barcode', [BarCodeController::class, 'index'])->name('index');
    Route::post('/store', [BarCodeController:: class, 'store'])->name('store');

    Route::get('/tracer', [TracerController::class, 'index'])->name('index');
    Route::get('/add_transmittal', [AddTransmittalController::class, 'index'])->name('new_transmittal');
    Route::get('/transmittals', [TransmittalsController::class, 'tracerForm']);
});

require __DIR__.'/auth.php';
