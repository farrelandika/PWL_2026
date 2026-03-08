<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;

Route::get('/greeting', [WelcomeController::class, 'greeting']);

Route::resource('photos', PhotoController::class);

Route::get('/', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/articles/{id}', [PageController::class, 'articles']);

Route::get('/articles/{id}', function ($id) {
    return 'Halaman Artikel dengan ID '.$id;
});

Route::get('/hello', [WelcomeController::class, 'hello']);

Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
});

Route::get('/user/{name?}', function ($name='John') {
    return 'Nama saya '.$name;
});

Route::get('/user/{name}', function ($name) {
    return 'Nama saya '.$name;
});

Route::get('/user/profile', function () {
    return 'Ini halaman profile';
})->name('profile');

Route::middleware(['auth'])->group(function () {

    Route::get('/user', function () {
        return 'Halaman User';
    });

    Route::get('/post', function () {
        return 'Halaman Post';
    });

    Route::get('/event', function () {
        return 'Halaman Event';
    });

});

Route::prefix('admin')->group(function () {

    Route::get('/user', function () {
        return 'Admin User Page';
    });

    Route::get('/post', function () {
        return 'Admin Post Page';
    });

    Route::get('/event', function () {
        return 'Admin Event Page';
    });

});

Route::redirect('/here', '/there');

Route::view('/welcome', 'welcome');