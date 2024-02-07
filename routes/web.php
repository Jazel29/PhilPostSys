<?php

use App\Http\Controllers\BarCodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransmittalController;
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
Route::get('/test', function(){
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //store the test barcode in the database
    Route::get('/barcode', [BarCodeController::class, 'index'])->name('index');
    Route::post('/store', [BarCodeController:: class, 'store'])->name('store');

    //Transmittal record routes
    Route::get('/newRecord', [TransmittalController::class, 'index'])->name('index');
    Route::post('/addRecord', [TransmittalController::class,'store'])->name('store');

});


require __DIR__.'/auth.php';
