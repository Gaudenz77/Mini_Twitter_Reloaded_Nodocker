<?php

    use App\Http\Controllers\ProfileController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\MessageController;
    use App\Http\Controllers\CommentController;

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

    Route::get('/', function () { return view('welcome');
    });

    // if messages should be localhost change above to this:
    /* Route::get('/', [MessageController::class, 'showAll']); */

    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    Route::get('/dashboard', function () { return view('dashboard'); })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Email Verification Routes...
// email verification routes must be defined before the auth route
/* Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send'); */

    require __DIR__.'/auth.php';

    Route::get('/messages', [MessageController::class, 'showAll']);

    Route::post('/create', [MessageController::class, 'create'])->middleware('auth');

    Route::get('/message/{id}', [MessageController::class, 'details']);

    Route::delete('/message/{id}', [MessageController::class, 'delete']);

    Route::post('/message/{id}/like', [MessageController::class, 'like']);

    Route::post('/message/{id}/dislike', [MessageController::class, 'dislike']);

    Route::post('/messages/{messageId}/comments', [CommentController::class, 'storeComment'])->name('comments.store');





