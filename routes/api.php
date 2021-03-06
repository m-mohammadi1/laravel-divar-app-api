<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);




Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::resource('user/advertises', App\Http\Controllers\Api\User\AdvertiseController::class);

    // upload photo routes
    Route::post('user/advertises/images', [App\Http\Controllers\Api\User\AdvertiseImageController::class, 'upload'])->name('user.advertise.image.upload');

    Route::post('logout', [AuthController::class, 'logout']);

    Route::group([
        'middleware' => 'admin',
        'prefix' => 'admin',
        'as' => 'admin.'
    ], function () {
        Route::post('categories', [App\Http\Controllers\Api\Main\CategoryController::class, 'store'])->name('categories.store');
        Route::put('categories/{id}', [App\Http\Controllers\Api\Main\CategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{id}', [App\Http\Controllers\Api\Main\CategoryController::class, 'destroy'])->name('categories.destroy');
    });
});


// category routes
Route::get('categories', [App\Http\Controllers\Api\Main\CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/{id}', [App\Http\Controllers\Api\Main\CategoryController::class, 'show'])->name('categories.show');


// advertise routes
Route::get('advertises' , [App\Http\Controllers\Api\Main\AdvertiseController::class, 'index'])->name('advertise.index');
Route::get('advertises/{id}' , [App\Http\Controllers\Api\Main\AdvertiseController::class, 'show'])->name('advertise.show');
// image routes
Route::get('advertises/{id}/images' , [App\Http\Controllers\Api\Main\AdvertiseController::class, 'show'])->name('advertise.images');


