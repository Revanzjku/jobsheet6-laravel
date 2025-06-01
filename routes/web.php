<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Models\Aktivitas;
use App\Models\Kelas;
use App\Models\Siswa;
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

Route::middleware('auth')->group(function () {
    
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::resource('siswa', SiswaController::class)
        ->except('show')
        ->parameters(['siswa'=>'siswa']);
        Route::resource('kelas', KelasController::class)
        ->except('show')
        ->parameters(['kelas'=>'kelas']);
    });

    Route::middleware('role:siswa')->prefix('siswa')->group(function () {
        
    });
});

Route::get('/dashboard', function () {

    return view('dashboard', [
        'siswa' => Siswa::all(),
        'kelas' => Kelas::all(),
        'items' => Aktivitas::latest()->take(3)->get()
    ]);
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
