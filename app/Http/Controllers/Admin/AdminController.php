<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Music;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Admin');
    }

    public function event(Request $request, $id)
    {
        return Inertia::render('Admin/Event', [
            'musics' => Music::query()->where('events_id', $id)->get(),
            'categories_id' => $id
        ]);
    }
}
