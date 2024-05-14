<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'room_post_id',
    ];
    public $timestamps = true;
    public function roomPost()
    {
        return $this->belongsTo(RoomPost::class);
    }

    // (Optional) If you want to define a relationship to the User model:
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
