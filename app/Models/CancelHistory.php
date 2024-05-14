<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_post_id',
        'reason',
    ];
    public function roomPost()
    {
        return $this->belongsTo(RoomPost::class, 'room_post_id');
    }
    public $timestamps = true;
}
