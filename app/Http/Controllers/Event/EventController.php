<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Music;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function event($id)
    {
        return Inertia::render('Event', [
            'events' => Event::query()->orderBy('name', 'asc')->get(),
            'music_id_last' => Music::query()->orderBy('id', 'desc')->where('events_id', $id)->first(),
            'selected' => $id
        ]);
    }
}
