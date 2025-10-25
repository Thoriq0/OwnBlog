<?php

use App\Livewire\HomeView;
use App\Livewire\AboutView;
use App\Livewire\AdminEdit;
use App\Livewire\PostedView;
use App\Livewire\SingleView;
use App\Livewire\AdminNewText;
use App\Livewire\CategoryView;
use App\Livewire\AdminSettings;
use App\Livewire\AdminTextList;
use App\Livewire\AdminDashboard;
use App\Http\Controllers\RouteHandle;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authentication;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PutHandleController;
use App\Http\Controllers\PostHandleController;
use App\Http\Controllers\GuestHandleController;
use App\Http\Controllers\DeleteHandleController;


// Route Guest
Route::get('/', HomeView::class)->name('guest.root');
Route::get('/post/read-{slug}', SingleView::class)->name('guest.single');
Route::get('/posts', PostedView::class)->name('guest.posted');
Route::get('/{category}/post', CategoryView::class)->name('guest.category');
Route::get('/about', AboutView::class)->name('guest.about');


// Admin Route
Route::middleware([Authentication::class . ':admin'])->group(function () {
    
    // Admin Route
    Route::get('/dashboard', AdminDashboard::class); // Dashboard
    Route::get('/your-text', AdminTextList::class)->name('your-text'); // Your Text / Own text
    Route::get('/new-text' , AdminNewText::class); // New Text / Write Text
    Route::get('/settings' , AdminSettings::class); // Settings -> Coming Soon

    Route::get('/{slug}/edited', AdminEdit::class)->name('post.edited'); // Show Edit Content
    
    // Post Handle
    Route::post('/admin/new-text', [PostHandleController::class, 'newText'])->name('post.newText'); // Upload New content


    // Put Handle
    Route::put('/updated/{id}/post', [PutHandleController::class, 'updateContent'])->name('post.updated'); // Update content

    // Delete Handle
    Route::delete('/content/{id}', [DeleteHandleController::class, 'destroyContent'])->name('content.delete');

});




Route::get('/login', [AuthController::class, 'showLoginPage'])->name('login'); //Login Page
Route::post('/login/auth', [AuthController::class, 'loginHandle']); 
Route::post('/logout', [AuthController::class, 'logout']); // Handle Logout
