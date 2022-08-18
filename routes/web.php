<?php

use App\Http\Controllers\RequestItemsController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [RequestItemsController::class, 'index'])->name('index');
Route::resource('/', RequestItemsController::class);
Route::get('/{id}', [RequestItemsController::class, 'show'])->name('show');
Route::delete('/transactionDetail/{id}', [RequestItemsController::class, 'destroyTransactionDetail'])->name('destroyTransactionDetail');
Route::delete('/{id}', [RequestItemsController::class, 'destroy'])->name('destroy');
Route::get('/ajaxphp', function(){
  return view('pages.request-items.ajax');
})->name('ajax');