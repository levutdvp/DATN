<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'point',
        'point_persent',
        'price_promotion',
        'coupon_id',
        'payment_method',
        'status',
        'points',
        'verification'
    ];

    public $timestamps = true;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function room_post()
    {
        return $this->belongsTo(RoomPost::class);
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
