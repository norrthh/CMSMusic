<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $fillable = ['events_id', 'name', 'mp4', 'video', 'text'];

    public function event()
    {
        return $this->hasOne(Event::class, 'id', 'events_id');
    }
}
