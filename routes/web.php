<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LaporanController;
use App\Http\Controllers\Dashboard\PemetaanController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Peta\MapController;
use Intervention\Image\Colors\Profile;

// Report
Route::get('/', [ReportController::class, 'index'])->name('reports.index');
Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
Route::get('/get/reports', [ReportController::class, 'showReportsMap'])->name('reports.show');


// Dashboard
Route::prefix('dashboard')->middleware('auth:admin')->group(function () {
    // rute dashboard Anda
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth:admin');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('dashboard.laporan');
    Route::get('/laporan/pdf', [LaporanController::class, 'generatePDF'])->name('export.pdf');
    

    Route::get('/laporan/validasi', [LaporanController::class, 'validasi'])->name('dashboard.laporan.validasi');
    Route::post('/reports/{id}/validate', [LaporanController::class, 'validateReport'])->name('reports.validate');

    Route::get('/peta', [MapController::class, 'index'])->name('dashboard.peta');
    Route::get('/peta/pemetaan', [MapController::class, 'pemetaan'])->name('dashboard.peta.pemetaan');

    Route::get('/profile', [ProfileController::class, 'index'])->name('dashboard.profile');
    Route::post('/admin/update-profile-picture', [ProfileController::class, 'updateProfilePicture'])->name('admin.updateProfilePicture');
    Route::get('/profile-picture/{filename}', [ProfileController::class, 'getProfilePicture'])->name('profile.picture');
    Route::get('/admin/remove-profile-picture', [ProfileController::class, 'removeProfilePicture'])->name('admin.removeProfilePicture');

    Route::post('/create', [MapController::class, 'createGeoJson'])->name('geojson.create');
    Route::post('/update', [MapController::class, 'updateGeoJson'])->name('geojson.update');
    Route::delete('/delete', [MapController::class, 'deleteGeoJson'])->name('geojson.delete');
});
Route::get('/geojson', [MapController::class, 'getGeoJson'])->name('geojson.get');

// Auth Routes
Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
Route::post('/login', [AdminController::class, 'login']);
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
Route::post('/change-password', [AdminController::class, 'changePassword'])->name('change.password');
