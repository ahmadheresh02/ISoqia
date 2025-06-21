<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    DashboardController,
    ProductController,
    OrderController,
    UserController,
    AboutUsController,
    ContactMessageController,
    IconController
};
use App\Http\Controllers\HomeController;

// Public routes
// Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])
//     ->name('contact.submit');

// Authenticated user routes (not admin)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Products Management
    Route::resource('products', ProductController::class)->except(['show']);
    Route::delete('products/{image}/image', [ProductController::class, 'deleteImage'])
        ->name('products.image.delete');
    Route::get('products/{product}/show', [ProductController::class, 'show'])
        ->name('products.show');

    // Orders Management
    Route::resource('orders', OrderController::class)->only(['index', 'show']);
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])
        ->name('orders.update-status');
    Route::get('orders/export', [OrderController::class, 'export'])
        ->name('orders.export');

    // Users Management
    Route::resource('users', UserController::class);
    Route::get('users/export', [UserController::class, 'export'])
        ->name('users.export');

    // About Us Management
    Route::prefix('about')->group(function () {
        Route::get('/', [AboutUsController::class, 'index'])->name('about.index');
        Route::get('/edit', [AboutUsController::class, 'edit'])->name('about.edit');
        Route::put('/', [AboutUsController::class, 'update'])->name('about.update');
    });

    // Contact Messages Management
    Route::prefix('contact-messages')->name('contact-messages.')->group(function () {
        Route::get('/', [ContactMessageController::class, 'index'])->name('index');
        Route::get('/trash', [ContactMessageController::class, 'trash'])->name('trash');
        Route::get('/{message}', [ContactMessageController::class, 'show'])->name('show');
        Route::delete('/{message}', [ContactMessageController::class, 'destroy'])->name('destroy');
        Route::patch('/{id}/restore', [ContactMessageController::class, 'restore'])->name('restore');
    });
    Route::resource('icons', IconController::class);
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'send'])->name('contact.send');


require __DIR__ . '/auth.php';
