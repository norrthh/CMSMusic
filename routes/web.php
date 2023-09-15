<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\Favorite\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Models\Event;
use App\Models\Music;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'musics' => Music::query()->orderBy('id', 'desc')->with('event')->get(),
        'events' => Event::query()->orderBy('name', 'asc')->get(),
        'music_id_last' => Music::query()->orderBy('id', 'desc')->first()
    ]);
})->name('index');

Route::get('event/{id}', [EventController::class, 'event'])->name('event');
Route::get('/favorite', [FavoriteController::class, 'favorite'])->name('favorite');
Route::prefix('admin')->name('admin.')->group(function (){
    Route::get('/', [AdminController::class, 'index']);
    Route::prefix('event')->name('event.')->group(function () {
        Route::get('/{id}', [AdminController::class, 'event'])->name('index');
    });
});


Route::get('/test', function () {
    phpinfo();
});
