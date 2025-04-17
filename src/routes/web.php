<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/users');
});

// Rotas do front-end users
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

// Rotas do front-end addresses
Route::get('/users/{id}/addresses', [AddressController::class, 'index'])->name('users.addresses');
Route::get('/users/{id}/addresses/create', [AddressController::class, 'create'])->name('users.addresses.create');
Route::post('/users/{id}/addresses', [AddressController::class, 'store'])->name('users.addresses.store');
Route::get('/users/{id}/addresses/{addressId}', [AddressController::class, 'show'])->name('users.addresses.show');
Route::get('/users/{id}/addresses/{addressId}/edit', [AddressController::class, 'edit'])->name('users.addresses.edit');
Route::put('/users/{id}/addresses/{addressId}', [AddressController::class, 'update'])->name('users.addresses.update');
Route::delete('/users/{id}/addresses/{addressId}', [AddressController::class, 'destroy'])->name('users.addresses.destroy');

// Rotas da API
Route::prefix('api')->group(function () {
    Route::apiResource('user', UserController::class);
    Route::apiResource('address', AddressController::class);
});

// Rota para buscar endereço por CEP usando o ViaCepService
Route::get('/buscar-cep/{cep}', [\App\Http\Controllers\CepController::class, 'buscar']);
