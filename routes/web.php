<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;


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
        Route::get('/dashboard', function () {
            return redirect('/mini-blog');
        })->name('dashboard');
    });


Route::middleware(['web', 'auth', 'admin'])
    ->group(function () {
        Route::patch('/admin/update-role/{user}', [AdminController::class, 'updateRole'])
            ->name('admin.updateRole');

        Route::get('/admin/all-users', [AdminController::class, 'allUsers'])->name('admin.allUsers');

        Route::get('/faq/create', [FaqController::class, 'createCategory'])->name('faq.createCategory');
        Route::post('/faq/create', [FaqController::class, 'saveCategory'])->name('faq.saveCategory');
        Route::post('/faq/save-category', [FaqController::class, 'saveCategory'])->name('faq.saveCategory');

        Route::get('/faq/{categoryId}/create-question', [FaqController::class, 'createQuestion'])->name('faq.createQuestion');
        Route::post('/faq/{categoryId}/save-question', [FaqController::class, 'saveQuestion'])->name('faq.saveQuestion');

        // Categories
        Route::get('/faq/category/{id}/edit', [FaqController::class, 'editCategory'])->name('faq.editCategory');
        Route::put('/faq/category/{id}/update', [FaqController::class, 'updateCategory'])->name('faq.updateCategory');
        Route::delete('/faq/category/{id}/delete', [FaqController::class, 'destroyCategory'])->name('faq.destroyCategory');

        // Questions
        Route::get('/faq/question/{id}/edit', [FaqController::class, 'editQuestion'])->name('faq.editQuestion');
        Route::put('/faq/question/{id}/update', [FaqController::class, 'updateQuestion'])->name('faq.updateQuestion');
        Route::delete('/faq/question/{id}/delete', [FaqController::class, 'destroyQuestion'])->name('faq.destroyQuestion');

        Route::get('/admin/contact-forms', [AdminController::class, 'showContactForms'])->name('admin.contactForms');
        Route::get('/admin/reply/{id}', [AdminController::class, 'replyToContactForm'])->name('admin.reply');
        Route::post('/admin/send-reply/{id}', [AdminController::class, 'sendReplyToContactForm'])->name('admin.sendReply');

        Route::get('/admin/reply/{id}', [ContactController::class, 'showContactFormReply'])->name('admin.reply');

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

    Route::get('/mini-blog', [PostController::class, 'index'])->name('mini-blog');

    Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

    // save posts to mySaves
    Route::post('/posts/{postId}/save', [PostController::class, 'savePost'])->name('posts.save');
    Route::get('/my-saves', [PostController::class, 'mySaves'])->name('my-saves');
    Route::delete('/my-saves/{postId}/remove', [PostController::class, 'removeSavedPost'])->name('posts.remove');

    Route::get('/contact', [ContactController::class, 'show'])->name    ('contact.show');
    Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

    Route::get('/about', [AboutController::class, 'index'])->name('about.index');

});


// Route::get('/contact', function(){
//     Mail::to('test@email.com')->send(new TestMail());
// });

