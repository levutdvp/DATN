<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'ward_id'
    ];

    public function roomPosts()
    {
        return $this->hasMany(RoomPost::class, 'district_id', 'id');
    }
}
