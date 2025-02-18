<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\InvestmentsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ReturnAmountsController;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'adminDashboard')->name('dashboard');
        Route::get('/savings/filter', 'savingsFilter')->name('savings.filter');
    });

    Route::controller(MemberController::class)->group(function () {
        Route::get('/member', 'index')->name('member');
        Route::post('/mamber/store', 'store')->name('member.store');
        Route::get('/mamber/view', 'view')->name('view.member');
        Route::get('/member/edit/{id}',  'edit')->name('member.edit');
        Route::put('/member/update/{id}',  'update')->name('member.update');
        Route::delete('/member/delete/{id}', 'delete')->name('member.delete');
    });
    Route::controller(SavingController::class)->group(function () {
        Route::get('/savings', 'index')->name('savings');
        Route::post('/savings/store', 'store')->name('savings.store');
        Route::get('/savings/view', 'view')->name('savings.view');
        Route::get('/savings/edit/{id}',  'edit')->name('savings.edit');
        Route::put('/savings/update/{id}',  'update')->name('savings.update');
        Route::delete('/savings/delete/{id}', 'delete')->name('savings.delete');
    });
    Route::controller(FineController::class)->group(function () {
        Route::get('/fines', 'index')->name('fines');
        Route::post('/fines/store', 'store')->name('fines.store');
        Route::get('/fines/view', 'view')->name('fines.view');
        Route::get('/fines/edit/{id}',  'edit')->name('fines.edit');
        Route::put('/fines/update/{id}',  'update')->name('fines.update');
        Route::delete('/fines/delete/{id}', 'delete')->name('fines.delete');
    });
    Route::controller(InvestmentsController::class)->group(function () {
        Route::get('/investment', 'index')->name('investment');
        Route::post('/investment/store', 'storeInvestment')->name('investment.store');
        Route::get('/investment/view', 'view')->name('investment.view');
        Route::get('/investment/edit/{id}',  'edit')->name('investment.edit');
        Route::put('/investment/update/{id}',  'update')->name('investment.update');
        Route::delete('/investment/delete/{id}', 'delete')->name('investment.delete');
    });
    Route::controller(SalesController::class)->group(function () {
        Route::get('/sales', 'index')->name('sales');
        Route::post('/sales/store', 'store')->name('sales.store');
        Route::get('/sales/view', 'view')->name('sales.view');
        Route::get('/sales/edit/{id}',  'edit')->name('sales.edit');
        Route::put('/sales/update/{id}',  'update')->name('sales.update');
        Route::delete('/sales/delete/{id}', 'delete')->name('sales.delete');
    });
    Route::controller(ReturnAmountsController::class)->group(function () {
        Route::get('/return/amounts', 'index')->name('return.amounts');
        Route::post('/return/amounts/store', 'store')->name('return.amounts.store');
        Route::get('/return/amounts/view', 'view')->name('return.amounts.view');
        Route::get('/return/amounts/edit/{id}',  'edit')->name('return.amounts.edit');
        Route::put('/return/amounts/update/{id}',  'update')->name('return.amounts.update');
        Route::delete('/return/amounts/delete/{id}', 'delete')->name('return.amounts.delete');
    });
});



require __DIR__.'/auth.php';
