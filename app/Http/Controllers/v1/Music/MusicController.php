<?php

namespace App\Http\Controllers\v1\Music;

use App\Http\Controllers\Controller;
use App\Models\Music;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function index(Request $request)
    {
        return Music::query()->where('events_id', $request->input('events_id'))->get();
    }

    public function get(Request $request)
    {
        if ($request->integer('selected')) {
            return Music::query()
                ->orderBy('id', 'desc')
                ->with('event')
                ->where('events_id', $request->integer('selected'))
                ->get();
        }
        return Music::query()->orderBy('id', 'desc')->with('event')->get();
    }

    public function store(Request $request)
    {
        return Music::query()->create([
            'events_id' => $request->input('events_id'),
            'mp4' => $request->input('mp4'),
            'name' => $request->input('name'),
            'video' => $request->input('clip'),
            'text' => $request->input('textTreck')
        ]);
    }

    public function search(Request $request)
    {
        return Music::query()
            ->where('name', 'LIKE', '%' . $request->input('text') . '%')
            ->orderBy('id', 'desc')
            ->with('event')
            ->get();
    }
}
