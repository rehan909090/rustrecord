<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MusicSubmissionController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\RoyaltyPaymentController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Payment routes accessible without login (for purchasing tickets)
Route::post('/concert/{concert}/payment', [PaymentController::class, 'createTransaction'])->name('payment.create');
Route::post('/payment/callback', [PaymentController::class, 'paymentCallback'])->name('payment.callback');


// Route for displaying tickets
Route::get('/ticket/{order_id}', [TransactionController::class, 'showTicket'])->name('ticket.show');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Dashboard route
    
    // User profile routes
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [UserProfileController::class, 'update'])->name('profile.update');
    
    // Music submission routes
    Route::get('/submit-music', [MusicSubmissionController::class, 'showForm'])->name('music.submit');
    Route::post('/submit-music', [MusicSubmissionController::class, 'submitMusic'])->name('music.store');

    // Concert routes
    Route::resource('concerts', ConcertController::class);

    // Music submissions management
    Route::get('/music-submissions', [MusicSubmissionController::class, 'index'])->name('music.submissions');
    Route::get('/music-submissions/{submission}/edit-status', [MusicSubmissionController::class, 'editStatusForm'])->name('music.submissions.edit-status');
    Route::put('/music-submissions/{submission}', [MusicSubmissionController::class, 'updateStatus'])->name('music.submissions.update-status');
    Route::delete('/music-submissions/{submission}', [MusicSubmissionController::class, 'destroy'])->name('music.submissions.destroy');

    // Artist management
    Route::resource('artists', ArtistController::class);

    Route::post('/midtrans/notification', [PaymentController::class, 'handleNotification']);
    Route::post('/payment/success/{concertId}/{amountPaid}', [PaymentController::class, 'handlePaymentSuccess']);
    
    
    // Song routes
    Route::resource('songs', SongController::class);
    Route::post('songs/{id}/play', [SongController::class, 'incrementPlayCount']);

 

    Route::get('royalty-payment/{artistId}', [RoyaltyPaymentController::class, 'showPaymentForm'])->name('royalty.payment.form');
    Route::post('royalty-payment/{artistId}', [RoyaltyPaymentController::class, 'processPayment'])->name('royalty.payment.process');
    
    
    
});


// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
