<?php

use App\Models\Drug;
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

Route::get('/', function () {
    return redirect()->route('admin.index');
});
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('admin.index');
    Route::get('/drug/expire_date', [App\Http\Controllers\IndexController::class, 'expire_date'])->name('admin.drugs.expire_date');
    Route::get('/drug/more', [App\Http\Controllers\IndexController::class, 'more'])->name('admin.drugs.more');
    Route::get('/drug/stock', [App\Http\Controllers\IndexController::class, 'stock'])->name('admin.drugs.stock');


    Route::prefix('users')->group(function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
        Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('admin.users.create');
        Route::post('/store', [App\Http\Controllers\UserController::class, 'store'])->name('admin.users.store');
        Route::get('/edit/{user}', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.users.edit');
        Route::post('/update/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/delete', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.users.destroy');
    });

    Route::prefix('drugs')->group(function () {
        Route::get('/', [App\Http\Controllers\DurgController::class, 'index'])->name('admin.drugs.index');
        Route::get('/create', [App\Http\Controllers\DurgController::class, 'create'])->name('admin.drugs.create');
        Route::post('/store', [App\Http\Controllers\DurgController::class, 'store'])->name('admin.drugs.store');
        Route::get('/edit/{drug}', [App\Http\Controllers\DurgController::class, 'edit'])->name('admin.drugs.edit');
        Route::post('/update/{drug}', [App\Http\Controllers\DurgController::class, 'update'])->name('admin.drugs.update');
        Route::delete('/delete', [App\Http\Controllers\DurgController::class, 'destroy'])->name('admin.drugs.destroy');
        Route::get('/list-dispense', [App\Http\Controllers\DurgController::class, 'list_dispense'])->name('admin.drugs.dispense.list');
        Route::get('/dispense', [App\Http\Controllers\DurgController::class, 'dispenseFront'])->name('admin.drugs.dispense');
        Route::get('/dispense/{drug}', [App\Http\Controllers\DurgController::class, 'dispenseStore'])->name('admin.drugs.dispense.store');

    });
});

Auth::routes(['register' => false]);



