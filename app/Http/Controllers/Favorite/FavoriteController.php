<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Music;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FavoriteController extends Controller
{
    public function favorite()
    {
        return Inertia::render('Favorite', [
            'musics' => Music::query()->orderBy('id', 'desc')->with('event')->get(),
            'events' => Event::query()->orderBy('name', 'asc')->get(),
            'music_id_last' => Music::query()->orderBy('id', 'desc')->first()
        ]);
    }
}
