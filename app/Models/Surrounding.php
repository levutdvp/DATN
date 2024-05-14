<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Surrounding extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'icon',
    ];
    public $timestamps = true;
    public function rooms()
    {
        return $this->belongsToMany(PostRoom::class, 'surrounding_rooms', 'surrounding_id', 'room_id');
    }
}
