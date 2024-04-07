<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;

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

Route::get('/', function (){
    return redirect('loan/create');
});

Route::group(['prefix'=>'loan'],function (){
    Route::get('/', [LoanController::class,'index'])->name('loan.index');
    Route::get('/create', [LoanController::class,'create']);
    Route::get('/show/{id}', [LoanController::class,'show'])->name('loan.show');
    Route::post('/store', [LoanController::class,'store'])->name('loan.store');

});
