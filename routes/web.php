<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepairRequestController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role === 'client') {
            return app(DashboardController::class)->clientDashboard();
        } elseif ($user->role === 'master') {
            return app(DashboardController::class)->masterDashboard();
        } elseif ($user->role === 'admin') {
            return app(DashboardController::class)->adminDashboard();
        }

        return redirect()->route('home');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

    Route::resource('repairs', RepairRequestController::class);
    Route::post('/repairs/{repair}/assign', [RepairRequestController::class, 'assign'])->name('repairs.assign')->middleware('role:master,admin');
    Route::patch('/repairs/{repair}/update-status', [RepairRequestController::class, 'updateStatus'])->name('repairs.update-status')->middleware('role:master,admin');

    Route::get('/masters', [MasterController::class, 'index'])->name('masters.index');
    Route::get('/masters/{master}', [MasterController::class, 'show'])->name('masters.show');
    Route::post('/master/update-profile', [MasterController::class, 'updateProfile'])->name('master.update-profile')->middleware('role:master');

    Route::post('/repairs/{repairRequest}/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('role:client');
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/masters/{master}/reviews', [ReviewController::class, 'getMasterReviews'])->name('reviews.master');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');

    Route::middleware('role:admin')->group(function () {
        Route::get('/reports/statistics', [ReportController::class, 'generalStats'])->name('reports.statistics');
        Route::get('/reports/master/{master}', [ReportController::class, 'masterStats'])->name('reports.master-stats');
        Route::get('/reports/client/{client}/history', [ReportController::class, 'clientHistory'])->name('reports.client-history');
        Route::post('/reports/export', [ReportController::class, 'exportReport'])->name('reports.export');
    });
});

require __DIR__.'/auth.php';
