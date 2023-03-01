<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
});

Auth::routes();

Route::prefix('painel')->middleware(['auth', 'can:panel'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('painel.home');

    /*
    |--------------------------------------------------------------------------
    | Usuários
    |--------------------------------------------------------------------------
    */
    Route::resource('users', App\Http\Controllers\Painel\ACL\UsersController::class);
    Route::resource('permissions', App\Http\Controllers\Painel\ACL\PermissionsController::class);
    Route::resource('roles', App\Http\Controllers\Painel\ACL\RolesController::class);
});
