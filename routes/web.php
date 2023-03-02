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

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Painel
    |--------------------------------------------------------------------------
    */
    Route::middleware('can:panel')->prefix('painel')->group(
        function () {
            Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('painel.home');

            /*
            |--------------------------------------------------------------------------
            | Usuários
            |--------------------------------------------------------------------------
            */
            Route::resource('users', App\Http\Controllers\Painel\ACL\UsersController::class);
            Route::resource('permissions', App\Http\Controllers\Painel\ACL\PermissionsController::class);
            Route::resource('roles', App\Http\Controllers\Painel\ACL\RolesController::class);
        }
    );

    Route::get('subscriptions/cancel', [App\Http\Controllers\Subscription\SubscriptionController::class, 'cancel'])->name('subscriptions.cancel');
    Route::get('subscriptions/resume', [App\Http\Controllers\Subscription\SubscriptionController::class, 'resume'])->name('subscriptions.resume');
    Route::get('subscriptions', [App\Http\Controllers\Subscription\SubscriptionController::class, 'index'])->name('subscriptions');
    Route::post('subscriptions/{subscriptionId}/store', [App\Http\Controllers\Subscription\SubscriptionController::class, 'store'])->name('subscriptions.store');
    Route::get('subscriptions/{subscriptionId}/checkout', [App\Http\Controllers\Subscription\SubscriptionController::class, 'show'])->name('subscriptions.show');
    Route::get('subscriptions/premium', [App\Http\Controllers\Subscription\SubscriptionController::class, 'premium'])->name('subscriptions.premium')->middleware('subscribed');
    Route::get('account', [App\Http\Controllers\Subscription\SubscriptionController::class, 'account'])->name('account');
});
