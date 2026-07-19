<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OwnerDashboardController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ProductionDetailsController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\QrScannerController;
use App\Http\Controllers\QrRecordController;
use App\Http\Controllers\QrTransactionController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/owner/users', [UserController::class, 'index'])
    ->name('owner.users');
    
// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])
    ->name('forgot.password');

Route::post('/forgot-password/check', [ForgotPasswordController::class, 'checkUsername'])
    ->name('forgot.check');

Route::post('/forgot-password/verify', [ForgotPasswordController::class, 'verifyAnswer'])
    ->name('forgot.verify');

Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword'])
    ->name('forgot.reset');

Route::view('/terms', 'terms')->name('terms');


/*
|--------------------------------------------------------------------------
| OWNER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [OwnerDashboardController::class, 'index'])
            ->name('dashboard');

        // Production
        Route::get('/production', [ProductionController::class, 'index'])
            ->name('production');

        // Inventory
        Route::get('/inventory', [InventoryController::class, 'index'])
            ->name('inventory');

        Route::post('/inventory/store', [InventoryController::class, 'store'])
            ->name('inventory.store');

        Route::delete('/inventory/delete/{id}', [InventoryController::class, 'destroy'])
            ->name('inventory.destroy');

        // Revenue
        Route::get('/revenue', [RevenueController::class, 'index'])
            ->name('revenue');

        Route::post('/revenue/store', [RevenueController::class, 'store'])
            ->name('revenue.store');

        // Dispatch
        Route::get('/dispatch', [DispatchController::class, 'index'])
            ->name('dispatch');

        Route::post('/dispatch/store', [DispatchController::class, 'store'])
            ->name('dispatch.store');

        Route::put('/dispatch/update/{dispatch}', [DispatchController::class, 'update'])
            ->name('dispatch.update');

        Route::delete('/dispatch/delete/{dispatch}', [DispatchController::class, 'destroy'])
            ->name('dispatch.destroy');

             Route::get('/owner/users', [UserController::class, 'index'])
        ->name('owner.users');
    });


/*
|--------------------------------------------------------------------------
| STAFF ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Production
    Route::get('/production', [ProductionController::class, 'index'])
        ->name('production');

    Route::get('/production/{id}/details', [ProductionDetailsController::class, 'index'])
        ->name('production.details');

    Route::get('/production/batch/{batch}', [BatchController::class, 'show'])
        ->name('batch.details');

    // Inventory
    Route::get('/inventory', [InventoryController::class, 'index'])
        ->name('inventory');

    Route::post('/inventory/store', [InventoryController::class, 'store'])
        ->name('inventory.store');

    Route::post('/inventory/update/{id}', [InventoryController::class, 'update'])
        ->name('inventory.update');

    Route::delete('/inventory/delete/{id}', [InventoryController::class, 'destroy'])
        ->name('inventory.destroy');

    // QR Scanner
    Route::get('/production/scan-qr', [QrScannerController::class, 'index'])
        ->name('production.scan');

    Route::post('/scan/store', [QrScannerController::class, 'store'])
        ->name('scan.store');

    // QR Records
    Route::post('/qr/generate', [QrRecordController::class, 'generate'])
        ->name('qr.generate');

    Route::get('/qr/list', [QrRecordController::class, 'index'])
        ->name('qr.list');

    Route::get('/qr/print', [QrRecordController::class, 'print'])
        ->name('qr.print');

    // QR Transactions
    Route::post('/qr-transactions/store', [QrTransactionController::class, 'store'])
        ->name('qr.transaction.store');

    Route::post('/qr/update/{id}', [QrTransactionController::class, 'update'])
        ->name('qr.update');

        Route::prefix('owner')->name('owner.')->group(function () {

    Route::get('/users', [UserController::class, 'index'])
        ->name('users');

    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('users.update');

    Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
        ->name('users.toggleStatus');

});
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});