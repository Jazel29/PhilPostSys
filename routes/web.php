<?php

use App\Http\Controllers\BarCodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransmittalController;
use App\Http\Controllers\TracerController;
use App\Http\Controllers\AddTransmittalController;
use App\Http\Controllers\TransmittalsController;
use App\Http\Controllers\AddresseeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExcelExportController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\TestStatus\Risky;
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



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //route for Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //store the test barcode in the database
    Route::get('/test', [BarCodeController::class, 'formTest']);
    Route::post('/addReturn', [BarCodeController:: class, 'addReturnCard'])->name('addReturnCard');
    Route::delete('/return-cards/{id}', [BarCodeController::class, 'destroy'])->name('return-cards.destroy');

    //Transmittal record routes
    Route::get('/tracer', [TransmittalController::class, 'index'])->name('formTest');
    Route::get('/transmittals/{id}', [TransmittalController::class, 'show']);
    Route::post('/addRecord', [TransmittalController::class,'store'])->name('store');
    //checks if mailTrackNum already exists
    Route::get('/checkMailTN', [TransmittalController::class, 'checkMailTN'])->name('checkMailTN');

    Route::get('/transmittals/{id}/edit', [TransmittalController::class, 'edit'])->name('edit');
    Route::patch('/transmittals/{id}/update', [TransmittalController::class, 'update'])->name('transmittals.update');
    Route::delete('/transmittals/{id}', [TransmittalController::class, 'destroy'])->name('transmittals.destroy');
    Route::delete('/return/{id}', [TransmittalController::class, 'deleteReturnCard'])->name('return.destroy');

    // Route::get('/tracer', [TracerController::class, 'index'])->name('index');
    Route::get('/add_transmittal', [AddTransmittalController::class, 'index'])->name('new_transmittal');
    Route::get('/transmittals', [TransmittalsController::class, 'tracerForm'])->name('transmittals.table');
    

    Route::post('/add_addressee', [AddresseeController::class, 'storeAddressee'])->name('store.addressee');
    Route::get('/get-addressees', [AddresseeController::class, 'getAddressees'])->name('get.addressees');
    Route::get('/new-addressee', [AddresseeController::class, 'showIndex'])->name('new.addressee');
    Route::get('/show-addressee', [AddresseeController::class, 'showAddresseeList'])->name('show.addressee');
    Route::delete('/remove-addressee/{id}', [AddresseeController::class, 'destroy'])->name('addressee.destroy');

    Route::get('/export-to-excel', [ExcelExportController::class, 'exportToExcel']);
    Route::get('/download-excel/{filename}', [ExcelExportController::class, 'downloadExcel'])->name('download-excel');


});


require __DIR__.'/auth.php';
