<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
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
Auth::routes();
Route::name('dashboard.')->middleware('auth')->group(function(){
    Route::resource('/', 'App\Http\Controllers\DashboardController');
});

Route::name('admin.')->group(function(){
    Route::resource('/users', UserController::class);
    Route::get('users/permission/{id}', [UserController::class, 'getPermission'])->name('users.getPermission');
    Route::post('users/permission/{id}', [UserController::class, 'postPermission'])->name('users.postPermission');
});

// roles
Route::name('admin.')->group(function(){
    Route::resource('/roles', RoleController::class);
});
