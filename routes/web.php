<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', fn() => 'Halaman homepage');

Route::get('/login', fn() => 'Halaman Login');
Route::post('/login', fn() => 'Proses Login');

Route::get('/register', fn() => 'Halaman Register');
Route::post('/register', fn() => 'Proses Register');

// Halaman pemohon
Route::get('/dashboard', fn() => 'Halaman Dashboard');
// Route::get('/permohonan', fn() => 'Halaman Senarai Permohonan');
Route::get('/permohonan/baru', fn() => 'Halaman Permohonan baru');
Route::post('/permohonan/baru', fn() => 'Proses Permohonan baru');

Route::get('/permohonan/{idpermohonan?}', function ($idpermohonan = null) {

    if (is_null($idpermohonan)) {
        return 'Ini Halaman Senarai';
    }

    return "Halaman Detail Permohonan {$idpermohonan}";

})->where('idpermohonan', '[0-9a-zA-Z]+');

Route::get('/helpdesk', fn() => 'Halaman Senarai tiket helpdesk')->name('helpdesk');
Route::get('/helpdesk/baru', fn() => 'Halaman Tiket baru <a href="' . route('helpdesk') . '">Kembali ke Senarai</a>');
Route::post('/helpdesk/baru', fn() => 'Proses Tiket baru');
Route::get('/helpdesk/{idtiket}', fn($idtiket) => "Halaman Detail tiket {$idtiket}");

// Halaman admin
// Route::prefix('admin')->group(function () {
//     Route::get('/dashboard', fn() => 'Halaman Dashboard Admin');
//     Route::get('/pemohon', fn() => 'Halaman Senarai Pemohon');
//     Route::get('/permohonan', fn() => 'Halaman Senarai Permohonan Admin');
//     Route::get('/helpdesk', fn() => 'Halaman Senarai Helpdesk Admin');
// });

Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', fn() => 'Halaman Dashboard Admin');
    Route::get('/pemohon', fn() => 'Halaman Senarai Pemohon');
    Route::get('/permohonan', fn() => 'Halaman Senarai Permohonan Admin');
    Route::get('/helpdesk', fn() => 'Halaman Senarai Helpdesk Admin');
});