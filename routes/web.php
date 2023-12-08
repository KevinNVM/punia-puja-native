<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TxController;
use App\Http\Controllers\RoleController;

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
    return view('welcome');
})->name('home');

Route::get('tx/subtotal', [TxController::class, 'subtotal'])->name('tx.subtotal');
Route::resource('tx', TxController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['auth', 'admin_only'])
        ->name('admin.')
        ->prefix('admin')
        ->group(function () {
            Route::get('/', [RoleController::class, 'index'])
                ->name('index');
            Route::get('/edit-roles/{user}', [RoleController::class, 'editRoles'])
                ->name('edit-role');
            Route::put('/edit-roles/{user}', [RoleController::class, 'updateUserRoles'])
                ->name('update-user-role');
            Route::post('/create-user', [RoleController::class, 'createNewUser'])
                ->name('create-user');
            Route::get('/delete-user/{user}', [RoleController::class, 'deleteUser'])
                ->name('delete-user');
        });

});
