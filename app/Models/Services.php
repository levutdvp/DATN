<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'price',
        'date_number',
        'color',
        'description',
    ];
    public $timestamps = true;

    public function roomPosts()
    {
        return $this->hasMany(RoomPost::class, 'service_id', 'id');

    }
}
