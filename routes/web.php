<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CountryListController;
use App\Http\Controllers\KursController; 
use App\Http\Controllers\BeritaController;

Route::get('/berita', [BeritaController::class, 'index']);

Route::get('/', [DashboardController::class, 'index']);

// Route Shipment
Route::resource('shipment', ShipmentController::class);

// Route Cuaca
Route::get('/cuaca', [WeatherController::class, 'index']);

// Route Negara World Bank (Indonesia)
Route::get('/negara', [CountryController::class, 'index']);

// Route Negara Global
Route::get('/countries', [CountryListController::class, 'index']);

// Route Kurs
Route::get('/kurs', [KursController::class, 'index']);