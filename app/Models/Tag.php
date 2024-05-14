<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Post;
use App\Models\RoomPost;

class Tag extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
    ];
    public $timestamps = true;

    public function posts(){
        return $this->morphedByMany(Post::class, 'taggables');
    }

    public function roomPosts(){
        return $this->morphedByMany(RoomPost::class, 'taggables');
    }
    public static function getAllTags()
    {
        return self::all();
    }
}
