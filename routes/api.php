<?php

use App\Http\Controllers\v1\Event\EventController;
use App\Http\Controllers\v1\Music\MusicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (){
    Route::prefix('event')->group(function (){
        Route::get('/', [EventController::class, 'index']);
        Route::post('/upload', [EventController::class, 'uploadFile']);
        Route::post('create', [EventController::class, 'store']);
    });

    Route::prefix('music')->group(function () {
        Route::post('/', [MusicController::class, 'index']);
        Route::post('/list', [MusicController::class, 'get']);
        Route::post('create', [MusicController::class, 'store']);
        Route::post('search', [MusicController::class, 'search']);
    });
});

// /api/v1/music/
