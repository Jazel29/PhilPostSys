<?php

use App\Http\Controllers\BarCodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransmittalController;
use App\Http\Controllers\TracerController;
use App\Http\Controllers\AddTransmittalController;
use App\Http\Controllers\TransmittalsController;
use App\Http\Controllers\AddresseeController;
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

    //store the test barcode in the database
    Route::get('/test', [BarCodeController::class, 'formTest']);
    // Route::post('/store', [BarCodeController:: class, 'store'])->name('store');
    Route::post('/addReturn', [BarCodeController:: class, 'addReturnCard'])->name('addReturnCard');

    //Transmittal record routes
    Route::get('/tracer', [TransmittalController::class, 'index'])->name('formTest');
    Route::get('/transmittals/{id}', [TransmittalController::class, 'show']);
    Route::post('/addRecord', [TransmittalController::class,'store'])->name('store');
    Route::patch('/transmittals/{id}/update', [TransmittalController::class, 'update']);
    Route::delete('/transmittals/delete', [TransmittalController::class, 'destroy'])->name('members.destroy');

    Route::resource('transmittals', TransmittalController::class);

    // Route::get('/tracer', [TracerController::class, 'index'])->name('index');
    Route::get('/add_transmittal', [AddTransmittalController::class, 'index'])->name('new_transmittal');
    Route::get('/transmittals', [TransmittalsController::class, 'tracerForm']);

    Route::post('/add_addressee', [AddresseeController::class, 'store'])->name('store');
    Route::get('/get-addressees', [AddresseeController::class, 'getAddressees'])->name('get.addressees');
});


require __DIR__.'/auth.php';
