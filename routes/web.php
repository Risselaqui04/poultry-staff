<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\QrScannerController;
use App\Http\Controllers\QrRecordController;
use App\Http\Controllers\QrTransactionController;
use App\Http\Controllers\ProductionDetailsController;
use App\Http\Controllers\OwnerDashboardController;
use App\Http\Controllers\DispatchController;



/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

// Login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

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
| Protected Routes
|--------------------------------------------------------------------------
*/

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

        // Dispatch
        Route::get('/dispatch', [DispatchController::class, 'index'])
            ->name('dispatch');

        Route::post('/dispatch/store', [DispatchController::class, 'store'])
            ->name('dispatch.store');

        Route::put('/dispatch/update/{dispatch}', [DispatchController::class, 'update'])
            ->name('dispatch.update');

        Route::delete('/dispatch/delete/{dispatch}', [DispatchController::class, 'destroy'])
            ->name('dispatch.destroy');
    });
/*
|--------------------------------------------------------------------------
| STAFF / CURRENT SYSTEM ROUTES
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

    // Forecast
    Route::view('/forecast', 'forecast')
        ->name('forecast');
        
    // Revenue
    Route::view('/revenue', 'revenue')
        ->name('revenue');

    // Users
    Route::view('/users', 'users')
        ->name('users');

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

    // Inventory
    Route::post('/inventory/store', [InventoryController::class, 'store'])
        ->name('inventory.store');

    Route::post('/inventory/update/{id}', [InventoryController::class, 'update'])
        ->name('inventory.update');

    Route::delete('/inventory/delete/{id}', [InventoryController::class, 'destroy'])
        ->name('inventory.destroy');

    // Dispatch
    Route::get('/dispatch', [DispatchController::class, 'index'])
        ->name('dispatch');

    Route::post('/dispatch/store', [DispatchController::class, 'store'])
        ->name('dispatch.store');

    Route::put('/dispatch/{dispatch}', [DispatchController::class, 'update'])
        ->name('dispatch.update');

    Route::delete('/dispatch/{dispatch}', [DispatchController::class, 'destroy'])
        ->name('dispatch.destroy');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});