<?php

use App\Http\Controllers\Mail\ContactoController;
use App\Http\Middleware\UserAdminMiddleware;
use App\Livewire\AdminUserPosts;
use App\Livewire\Home;
use App\Livewire\Tags;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto.index');
Route::post('/contacto', [ContactoController::class, 'sendMail'])->name('contacto.send');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/userposts', AdminUserPosts::class)->name('userposts');
    Route::get('/tags', Tags::class)->middleware(UserAdminMiddleware::class)->name('admintags');
});
