<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;


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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->name('dashboard');
});


Route::middleware(['web', 'auth', 'admin'])
->group(function () {
    Route::patch('/admin/update-role/{user}', [AdminController::class, 'updateRole'])
    ->name('admin.updateRole')
    ->middleware(['web', 'auth','admin']);  
    
    
});

     
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
    
// route for creating a user -> admins only
Route::post('/admin/create-user', [AdminController::class, 'createUser'])
->name('admin.createUser');
    
;
