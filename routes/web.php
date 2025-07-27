<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\ShipmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('clients', ClientController::class);

Route::resource('cargo', CargoController::class);

Route::resource('ships', ShipController::class);

Route::resource('crew', CrewController::class);

Route::resource('ports', PortController::class);

Route::resource('shipments', ShipmentController::class);

Route::patch('/clients/{client}/reactivate', [ClientController::class, 'reactivate'])->name('clients.reactivate');


