<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'icon',
        'description',
    ];

    public $timestamps = true;

    public function rooms()
    {
        return $this->belongsToMany(PostRoom::class, 'facility_rooms', 'room_id', 'facility_id');
    }
}
