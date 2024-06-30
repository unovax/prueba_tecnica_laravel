<?php

use App\Livewire\ClientComponent;
use App\Livewire\ProductComponent;
use App\Livewire\ServiceComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/servicios');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('servicios', ServiceComponent::class)->name('services');
    Route::get('clientes', ClientComponent::class)->name('clients');
    Route::get('productos', ProductComponent::class)->name('products');
});
