<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;

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
            ->name('admin.updateRole');

        Route::get('/admin/all-users', [AdminController::class, 'allUsers'])->name('admin.allUsers');
    });

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // route for creating a user -> admins only
    Route::post('/admin/create-user', [AdminController::class, 'createUser'])
        ->name('admin.createUser');

    Route::resource('posts', PostController::class)->names([
        'index' => 'posts.index',
        'create' => 'posts.create',
        'store' => 'posts.store',
        'show' => 'posts.show',
        'edit' => 'posts.edit',
        'update' => 'posts.update',
        'destroy' => 'posts.destroy',
    ]);

    Route::middleware(['auth'])->get('/mini-blog', [PostController::class, 'index'])->name('mini-blog');
});
