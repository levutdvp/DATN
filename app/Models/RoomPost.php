<?php

namespace App\Models;

use App\Models\Services;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'address',
        'address_full',
        'acreage',
        'empty_room',
        'description',
        'image',
        'status',
        'managing',
        'user_id',
        'service_id',
        'ward_id',
        'district_id',
        'city_id',
        'category_room_id',
        'fullname',
        'phone',
        'email',
        'zalo',
        'time_start',
        'time_end'
    ];
    public function cancelHistories()
    {
        return $this->hasMany(CancelHistory::class, 'room_post_id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    public function ward()
    {
        return $this->belongsTo(ward::class, 'ward_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categoryroom()
    {
        return $this->belongsTo(CategoryRoom::class, 'category_room_id', 'id');
    }
    public function surrounds()
    {
        return $this->belongsToMany(Surrounding::class, 'surrounding_rooms', 'room_id', 'surrounding_id');
    }
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'facility_rooms', 'room_id', 'facility_id');
    }
    public function categoryPost()
    {
        return $this->belongsTo(CategoryPost::class);
    }
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggables');
    }
    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
