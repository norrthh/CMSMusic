<?php

namespace App\Http\Controllers\v1\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function uploadFile(Request $request)
    {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);

        return response()->json([
            'message' => 'Файл успешно загружен',
            'url' => 'uploads/' . $fileName
        ]);
    }

    public function store(Request $request)
    {
        Event::query()->create([
            'name' => $request->name,
            'photo' => $request->photo
        ]);

        return response()->json([
            'message' => 'Вы успешно создали'
        ]);
    }

    public function index()
    {
        return Event::query()->get();
    }
}
