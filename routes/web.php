<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GlobalCountryController;
use App\Http\Controllers\KursController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\RisikoController;
use App\Http\Controllers\ComparisonController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\ApiController;

// Favorite
Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite.index');
Route::post('/favorite', [FavoriteController::class, 'store'])->name('favorite.store');
Route::delete('/favorite/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

Route::get('/comparison', [ComparisonController::class,'index'])
    ->name('comparison');

Route::get('/risiko', [RisikoController::class, 'index']);

Route::get('/tracking', [TrackingController::class, 'index']);

// Dashboard
Route::get('/', [DashboardController::class, 'index']);

// Shipment
Route::resource('shipment', ShipmentController::class);

// Cuaca
Route::get('/cuaca', [WeatherController::class, 'index']);

// Pelabuhan Global
Route::get('/ports', [PortController::class, 'index'])->name('ports.index');

// 🌍 Negara Global (API)
Route::get('/countries', [GlobalCountryController::class, 'index']);

// Negara World Bank
Route::get('/negara', [CountryController::class, 'index']);

// Kurs
Route::get('/kurs', [KursController::class, 'index']);

// Berita
Route::get('/berita', [BeritaController::class, 'index']);

// Admin Dashboard
Route::get('/admin', function () {
    return view('admin.dashboard');
});
Route::get('/admin/users', function () {
    return view('admin.users.index');
});
Route::get('/admin/ports', function () {
    return view('admin.ports.index');
});
Route::get('/admin/articles', function () {
    return view('admin.articles.index');
});

// 🛠 REST API endpoints
Route::prefix('api')->group(function () {
    Route::get('/countries', [ApiController::class, 'countries']);
    Route::get('/shipments', [ApiController::class, 'shipments']);
    Route::get('/risiko', [ApiController::class, 'risiko']);
    Route::get('/berita', [ApiController::class, 'berita']);
});