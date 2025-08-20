<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PemohonController;
use App\Http\Controllers\HelpdeskController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\RegisterController;

Route::get('/', HomeController::class)->name('home');

// Authentication Routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'borangLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'prosesBorangLogin'])->name('login.proses');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.proses');
});

// Logout Routes (Authenticated users only)
Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout.post');
});

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Pemohon Routes (Authenticated users only)
// Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PemohonController::class, 'dashboard'])->name('pemohon.dashboard');
    
    // Permohonan Routes
    Route::get('/permohonan', [PermohonanController::class, 'index'])->name('pemohon.permohonan.senarai');
    Route::get('/permohonan/baru', [PermohonanController::class, 'create'])->name('pemohon.permohonan.baru');
    Route::post('/permohonan/baru', [PermohonanController::class, 'store'])->name('pemohon.permohonan.store');
    Route::get('/permohonan/{id}/edit', [PermohonanController::class, 'edit'])->name('pemohon.permohonan.edit');
    Route::put('/permohonan/{id}', [PermohonanController::class, 'update'])->name('pemohon.permohonan.update');
    Route::get('/permohonan/{id}', [PermohonanController::class, 'show'])->name('pemohon.permohonan.detail');
    Route::delete('/permohonan/{id}', [PermohonanController::class, 'destroy'])->name('pemohon.permohonan.delete');
    
    Route::get('permohonan/search', [PermohonanController::class, 'search']);
    //Route::resource('permohonan', PermohonanController::class);
    
    // Helpdesk Routes
    Route::get('/helpdesk', [HelpdeskController::class, 'index'])->name('pemohon.helpdesk.senarai');
    Route::get('/helpdesk/baru', [HelpdeskController::class, 'create'])->name('pemohon.helpdesk.baru');
    Route::post('/helpdesk/baru', [HelpdeskController::class, 'store'])->name('pemohon.helpdesk.store');
    Route::get('/helpdesk/{id}', [HelpdeskController::class, 'show'])->name('pemohon.helpdesk.detail');
    Route::post('/helpdesk/{id}/reply', [HelpdeskController::class, 'reply'])->name('pemohon.helpdesk.reply');
// });

// Admin Routes (Authenticated admin users only)
Route::group([
    'prefix' => 'admin',
    //'middleware' => ['auth', 'admin']
], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/pemohon', [AdminController::class, 'pemohon'])->name('admin.pemohon');
    Route::get('/permohonan', [AdminController::class, 'permohonan'])->name('admin.permohonan');
    Route::get('/helpdesk', [AdminController::class, 'helpdesk'])->name('admin.helpdesk');
});

// Test