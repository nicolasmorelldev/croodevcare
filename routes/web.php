<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\CauseController as AdminCauseController;
use App\Http\Controllers\Admin\CauseImageController;
use App\Http\Controllers\Admin\CauseUpdateController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonationAmountPresetController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\DonationMethodController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\NeedItemController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Public\CauseController;
use App\Http\Controllers\Public\CollaborationInquiryController;
use App\Http\Controllers\Public\DonationController;
use App\Http\Controllers\Public\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/causes/{cause:slug}', [CauseController::class, 'show'])->name('causes.show');
Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');
Route::post('/collaboration-inquiries', [CollaborationInquiryController::class, 'store'])
    ->name('collaboration-inquiries.store');

$adminPath = config('croodev.admin_path');

Route::prefix($adminPath)->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('admin.login.store');

    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
        Route::get('/', DashboardController::class)->name('admin.dashboard');
        Route::resource('causes', AdminCauseController::class)->names('admin.causes');
        Route::resource('updates', CauseUpdateController::class)->names('admin.updates');
        Route::resource('gallery', CauseImageController::class)->names('admin.gallery');
        Route::resource('presets', DonationAmountPresetController::class)->names('admin.presets');
        Route::resource('needs', NeedItemController::class)->names('admin.needs');
        Route::resource('methods', DonationMethodController::class)->names('admin.methods');
        Route::resource('faqs', FaqController::class)->names('admin.faqs');
        Route::resource('testimonials', TestimonialController::class)->names('admin.testimonials');
        Route::resource('users', UserController::class)->names('admin.users');
        Route::resource('donations', AdminDonationController::class)
            ->only(['index', 'show'])
            ->names('admin.donations');
        Route::get('/settings', [SettingController::class, 'edit'])->name('admin.settings.edit');
        Route::put('/settings', [SettingController::class, 'update'])->name('admin.settings.update');
    });
});
