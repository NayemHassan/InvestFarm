<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SavingController;
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
        Route::get('/savings/view', 'view')->name('view.savings');
        Route::get('/savings/edit/{id}',  'edit')->name('savings.edit');
        Route::put('/savings/update/{id}',  'update')->name('savings.update');
        Route::delete('/savings/delete/{id}', 'delete')->name('savings.delete');
    });
});



require __DIR__.'/auth.php';
