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
use App\Http\Controllers\ContactController;

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

// Route::resource('admin/products', ProductController::class);
// Route::resource('admin/about', AboutController::class)->only(['edit', 'update']);


// filepath: routes/web.php

// Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
// Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


Route::get('/contact', function () {
    return view('contact'); // Assuming your form is in resources/views/contact.blade.php
})->name('contact');

// Route to handle form submission (POST)
Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');

// Optional: Route for admin to view contact messages
// Route::get('/admin/contact-messages', function () {
//     $messages = \App\Models\ContactMessage::with('deleted_at')
//         ->orderBy('created_at', 'desc')
//         ->get();

//     return view('admin.contact-messages', compact('messages'));
// })->name('admin.contact.index');

// Optional: Route to mark message as read
// Route::patch('/admin/contact-messages/{contactMessage}/read', function (\App\Models\ContactMessage $contactMessage) {
//     $contactMessage->markAsRead();
//     return back()->with('success', 'Message marked as read');
// })->name('admin.contact.read');
require __DIR__ . '/auth.php';
