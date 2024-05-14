<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageRoom extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'room_id'
    ];
    public function roompost()
    {
        return $this->belongsTo(RoomPost::class);
    }
}
