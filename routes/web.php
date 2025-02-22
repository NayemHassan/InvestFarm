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
use App\Http\Controllers\AsignSaleAmountController;
use App\Http\Controllers\ReportController;


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
Route::get('/admin/logout', [AdminController::class,'destroy'])->name('admin.logout');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'adminDashboard')->name('dashboard');
        Route::get('/savings/filter', 'savingsFilter')->name('savings.filter');
        // Route::get('/admin/logout', 'adminLogout')->name('admin.logout');
        Route::get('/user/profile', 'userProfile')->name('user.profile');
        Route::post('/user/profile/update', 'userProfileUpdate')->name('admin.update.profile');
    });

    Route::controller(MemberController::class)->group(function () {
        Route::get('/member', 'index')->name('member');
        Route::post('/mamber/store', 'store')->name('member.store');
        Route::get('/mamber/view', 'view')->name('view.member');
        Route::get('/member/edit/{id}',  'edit')->name('member.edit');
        Route::put('/member/update/{id}',  'update')->name('member.update');
        Route::delete('/member/delete/{id}', 'delete')->name('member.delete');
        Route::get('/make/user', 'MakeUser')->name('make.user');
        Route::get('/view/users', 'viewUsers')->name('view.users');
        Route::post('/make/user/store', 'userStore')->name('make.user.store');
        Route::put('/update/user/{id}', 'userUpdate')->name('update.user');
        Route::get('/user/edit/{id}',  'editUser')->name('user.edit');
        Route::delete('/user/delete/{id}',  'deleteUser')->name('user.delete');
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
        Route::get('/get-members/{sale_id}',  'getMembers');
        Route::get('/get-remaining-amount/{sale_id}/{member_id}',  'getMembersAssignAmount');

    });
    Route::controller(AsignSaleAmountController::class)->group(function () {
        Route::get('/Assign/Sale/Amount', 'index')->name('assign.amount');
        Route::post('/Assign/Sale/Amount/store', 'store')->name('assign.amount.store');
        Route::get('/Assign/Sale/Amount/view', 'view')->name('assign.amount.view');
        Route::get('/Assign/Sale/Amount/edit/{id}',  'edit')->name('assign.amount.edit');
        Route::put('/Assign/Sale/Amount/{id}',  'update')->name('assign.amount.update');
        Route::delete('/Assign/Sale/Amount//delete/{id}', 'delete')->name('assign.amount.delete');
        Route::get('/get-sale-amount/{sale_id}',  'getSaleAmount');
        Route::get('/get-available-members/{sale_id}', 'getAvailableMembers');

    });
    Route::controller(ReportController::class)->group(function () {
        Route::get('/individual/collection/due/report', 'viewCollectionDueReport')->name('collection.due.report');
        Route::get('/filter-sale-report', 'filterSaleReport')->name('filterSaleReport');
    });
});

require __DIR__.'/auth.php';
