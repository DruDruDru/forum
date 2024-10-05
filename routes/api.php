<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::group([
    'controller' => PostController::class
], function () {
    Route::get('posts', 'list');
    Route::post('posts', 'store');
});
