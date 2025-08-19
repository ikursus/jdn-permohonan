<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('authentication.template-login');
})->name('login');

Route::post('/login', fn() => 'Proses Login')->name('login.proses');

Route::get('/pendaftaran', function() {
    return view('authentication.register');
})->name('register');

Route::post('/register', fn() => 'Proses Register')->name('register.proses');

Route::get('logout', function() {
    return redirect()->route('login');
})->name('logout');

// Halaman pemohon
Route::get('/dashboard', function () {
    return view('pemohon.template-dashboard');
})->name('pemohon.dashboard');


Route::get('/permohonan', function () {

    $pageTitle = 'Senarai Permohonan Pekerja';

    $senaraiPermohonan = [
        ['id' => 1, 'nama' => 'Ali', 'no_kp' => '808080808080'],
        ['id' => 2, 'nama' => 'Ahmad', 'no_kp' => '808080808080'],
        ['id' => 3, 'nama' => '<strong>Siti<strong>', 'no_kp' => '<strong>test</strong>'],
        ['id' => 4, 'nama' => 'Upin', 'no_kp' => '808080808080'],
        ['id' => 5, 'nama' => 'Ah Leong', 'no_kp' => '808080808080'],

    ];

    // Cara 1 passing data / attach data ke template
    // return view('permohonan.template-senarai')
    // ->with('senaraiPermohonan', $senaraiPermohonan)
    // ->with('title', $pageTitle);

    // // Cara 2 passing data / attach data ke template
    // return view('permohonan.template-senarai', [
    //     'senaraiPermohonan' => $senaraiPermohonan, 
    //     'title' => $pageTitle
    // ]);

    // Cara 3 passing data / attach data ke template
    return view('pemohon.permohonan.template-senarai', compact('senaraiPermohonan', 'pageTitle'));

})->name('pemohon.permohonan.senarai');


Route::get('/permohonan/baru', function() {
    return view('pemohon.permohonan.template-baru');
})->name('pemohon.permohonan.baru');
Route::post('/permohonan/baru', fn() => 'Proses Permohonan baru')->name('pemohon.permohonan.proses');

Route::get('/permohonan/{idpermohonan?}', function ($idpermohonan = null) {

    if (is_null($idpermohonan)) {
        return 'Ini Halaman Senarai';
    }

    // return "Halaman Detail Permohonan {$idpermohonan}";
    return redirect()->route('helpdesk');

})->name('pemohon.permohonan.detail');

Route::get('/helpdesk', function() {
    return view('pemohon.helpdesk.template-senarai');
})->name('pemohon.helpdesk');

// Alias untuk konsistensi nama route
Route::get('/helpdesk', function() {
    return view('pemohon.helpdesk.template-senarai');
})->name('pemohon.helpdesk.senarai');
Route::get('/helpdesk/baru', function() {
    return view('pemohon.helpdesk.template-baru');
})->name('pemohon.helpdesk.baru');
Route::post('/helpdesk/baru', fn() => 'Proses Tiket baru')->name('pemohon.helpdesk.proses');
Route::get('/helpdesk/{idtiket}', function($idtiket) {
    return view('pemohon.helpdesk.template-detail', compact('idtiket'));
})->name('pemohon.helpdesk.detail');
Route::post('/helpdesk/{idtiket}/reply', function($idtiket) {
    return 'Proses Reply Tiket ' . $idtiket;
})->name('pemohon.helpdesk.reply');

// Halaman admin
// Route::prefix('admin')->group(function () {
//     Route::get('/dashboard', fn() => 'Halaman Dashboard Admin');
//     Route::get('/pemohon', fn() => 'Halaman Senarai Pemohon');
//     Route::get('/permohonan', fn() => 'Halaman Senarai Permohonan Admin');
//     Route::get('/helpdesk', fn() => 'Halaman Senarai Helpdesk Admin');
// });

// Route::get('/admin/dashboard', fn() => 'Halaman Dashboard Admin')->middleware('auth');
// Route::get('/admin/pemohon', fn() => 'Halaman Senarai Pemohon')->middleware('auth');
// Route::get('/admin/permohonan', fn() => 'Halaman Senarai Permohonan Admin')->middleware('auth');
// Route::get('/admin/helpdesk', fn() => 'Halaman Senarai Helpdesk Admin')->middleware('auth');


// Route::middleware('auth')->group(function() {

//     Route::prefix('admin')->group(function () {

//         Route::get('/dashboard', fn() => 'Halaman Dashboard Admin');
//         Route::get('/pemohon', fn() => 'Halaman Senarai Pemohon');
//         Route::get('/permohonan', fn() => 'Halaman Senarai Permohonan Admin');

//     });
// });

Route::group([
    'prefix' => 'admin', 
    //'middleware' => 'auth'
], function () {
    Route::get('/dashboard', function() {
        return view('admin.template-dashboard');
    });
    Route::get('/pemohon', function() {
        return view('admin.template-pemohon');
    });
    Route::get('/permohonan', function() {
        return view('admin.template-permohonan');
    });
    Route::get('/helpdesk', function() {
        return view('admin.template-helpdesk');
    });
});

// Test