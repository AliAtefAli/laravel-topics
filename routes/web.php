<?php

use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);
//Route::get('users', [\App\Http\Controllers\Api\V1\UsersController::class, 'index']);
Route::get('chat', [\App\Http\Controllers\ChatController::class, 'index'])->middleware('auth');
Route::get('dashboard', function () {
    return true;
})->middleware('admin');

Route::get('gallery', function () {
    dd(
        glob(public_path('assets/uploads/users/*.jpg'))
    );

    /**
     * Get Uploaded images
     */
//        $result = [];
//        foreach (glob(public_path('assets/images/posts/*')) as $image){
//            if (str_contains($image, '2022')){
//                $result[] = $image;
//            }
//        }
//        dd($result);
});


// 32131

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
