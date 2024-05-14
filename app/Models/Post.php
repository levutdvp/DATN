<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Tag;


class Post extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'title',
        'metaTitle',
        'image',
        'description',
        'metaDescription',
        'slug',
        'status',
        'view',
        'user_id',
        'category_post_id'
    ];
    public $timestamps = true;


    public function tags(){
        return $this->morphToMany(Tag::class, 'taggables');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function category_posts()
    {
        return $this->belongsTo(CategoryPost::class,'category_post_id','id');
    }
}
