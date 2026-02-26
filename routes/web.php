<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\LandingPageController;

Route::get('/', [LandingPageController::class, 'index'])->name('landing');

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
// Override default home redirect
Route::get('/home', function() { return redirect()->route('dashboard'); });

Route::middleware('auth')->group(function() {
    Route::get('/subscription', [\App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscription.index');
    Route::post('/subscription/{package}/checkout', [\App\Http\Controllers\PaymentController::class, 'checkout'])->name('subscription.checkout');

    Route::get('/invitation/{invitation}/edit', [\App\Http\Controllers\InvitationController::class, 'edit'])->name('invitation.edit');
    Route::put('/invitation/{invitation}', [\App\Http\Controllers\InvitationController::class, 'update'])->name('invitation.update');
});

// Public Invitation Route
Route::post('/{invitation}/rsvp', [\App\Http\Controllers\GuestbookController::class, 'store'])->name('rsvp.store');
Route::get('/preview/{slug}', [\App\Http\Controllers\Admin\TemplateController::class, 'preview'])->name('template.preview');
Route::get('/{invitation}', [\App\Http\Controllers\PublicInvitationController::class, 'show'])->name('invitation.show');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('packages', \App\Http\Controllers\Admin\PackageController::class);
    Route::resource('templates', \App\Http\Controllers\Admin\TemplateController::class);
    Route::resource('music', \App\Http\Controllers\Admin\MusicController::class);
    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::post('users/{user}/activate', [\App\Http\Controllers\Admin\UserController::class, 'activateForOffline'])->name('users.activate');
    Route::get('revenue', [\App\Http\Controllers\Admin\RevenueController::class, 'index'])->name('revenue.index');
});

// Mempelai / Client Routes
Route::middleware(['auth', 'role:mempelai'])->prefix('mempelai')->name('mempelai.')->group(function () {
    Route::get('/paket', [\App\Http\Controllers\Mempelai\PackageController::class, 'index'])->name('paket.index');
});
