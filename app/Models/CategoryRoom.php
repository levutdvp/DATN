<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CategoryRoom extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'status',
        'description'
    ];
    public function roomPosts()
    {
        return $this->hasMany(RoomPost::class);
    }
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($categoryroom) {
            $roomPostsToUpdate = RoomPost::where('category_room_id', $categoryroom->id)->get();

            foreach ($roomPostsToUpdate as $roomPost) {
                $roomPost->category_room_id = 1;
                $roomPost->save();
            }
        });
    }
}
