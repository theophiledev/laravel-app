<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConfirmMealController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TakeFoodController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\MealConfirmedNotification;
use App\Models\User;
use App\Http\Controllers\MealCostController;

Route::get('/', function () {
    return view('welcome');
});

// Comments Routes
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');

// Session-based dashboard routes (no login required)
Route::get('/dashboard', function () {
    // Set session to indicate dashboard access
    session(['dashboard_access' => true]);
    return view('dashboard');
})->name('dashboard');

Route::get('/manager-dashboard', function () {
    session(['dashboard_access' => true]);
    return view('manager-dashboard');
})->name('manager-dashboard');

Route::get('/admin-dashboard', function () {
    session(['dashboard_access' => true]);
    return view('admin-dashboard');
})->name('admin-dashboard');

Route::get('/work-dashboard', function () {
    session(['dashboard_access' => true]);
    return view('work-dashboard');
})->name('work-dashboard');

// Print Card Route
Route::get('/print-card/{user}', function (User $user) {
    return view('print-card', compact('user'));
})->name('print.card');

// Generate QR Code Route
Route::get('/generate-qr/{user}', function (User $user) {
    if (!$user->qr_code || !file_exists(public_path($user->qr_code))) {
        $qrData = url("/confirm_meal/{$user->id}");
        $qrPath = "qrcodes/{$user->id}_qrcode.svg";
        
        // Create qrcodes directory if it doesn't exist
        $qrDirectory = public_path('qrcodes');
        if (!file_exists($qrDirectory)) {
            mkdir($qrDirectory, 0755, true);
        }

        \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
            ->size(200)
            ->generate($qrData, public_path($qrPath));

        $user->qr_code = $qrPath;
        $user->save();
    }
    
    return redirect()->route('print.card', $user);
})->name('generate.qr');

// Confirm Meal Routes
Route::get('/confirm_meal/{user}', [ConfirmMealController::class, 'show'])->name('confirm_meal.show');
Route::post('/confirm_meal/{user}/verify', [ConfirmMealController::class, 'verify'])->name('confirm_meal.verify');
Route::post('/confirm_meal/{user}/confirm', [ConfirmMealController::class, 'confirm'])->name('confirm_meal.confirm');

// Settings Routes
Route::middleware('auth')->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
    Route::post('/settings/passkey', [SettingsController::class, 'updatePasskey'])->name('settings.passkey');
});

// Take Food Routes
Route::middleware('auth')->group(function () {
    Route::get('/take-food', [TakeFoodController::class, 'index'])->name('take-food');
    Route::post('/take-food/access', [TakeFoodController::class, 'accessMeal'])->name('take-food.access');
    Route::get('/take-food/payment', [TakeFoodController::class, 'showPayment'])->name('take-food.payment');
    Route::post('/take-food/payment', [TakeFoodController::class, 'processPayment'])->name('take-food.payment.process');
});

// Manager Routes (only for managers and admins)
Route::middleware(['auth', 'role:manager,admin'])->group(function () {
    Route::get('/manager/meal-costs', [MealCostController::class, 'index'])->name('manager.meal-costs');
    Route::post('/manager/meal-costs/bulk-update', [MealCostController::class, 'updateAllMealCosts'])->name('manager.meal-costs.bulk-update');
    Route::post('/manager/meal-costs/{user}/update', [MealCostController::class, 'updateUserMealCost'])->name('manager.meal-costs.update');
    
    // Comment Management Routes
    Route::get('/manager/comments', [CommentController::class, 'manage'])->name('manager.comments');
    Route::patch('/manager/comments/{comment}/approve', [CommentController::class, 'approve'])->name('manager.comments.approve');
    Route::patch('/manager/comments/{comment}/reject', [CommentController::class, 'reject'])->name('manager.comments.reject');
    Route::post('/manager/comments/{comment}/respond', [CommentController::class, 'respond'])->name('manager.comments.respond');
});

// Test email route (development only)
Route::get('/test-email/{user}', function (User $user) {
    $foodTaken = $user->foodTaken;
    Mail::to($user->email)->send(new MealConfirmedNotification($user, $foodTaken, 5, 45));
    return 'Test email sent to ' . $user->email;
})->name('test.email');

// Auth routes (for users who want to login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
