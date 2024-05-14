<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;
    // protected $dateFormat = 'U';
    protected $fillable = [
        'name',
        'type',
        'value',
        'quantity',
        'description',
        'status',
        'start_date',
        'end_date'
    ];
    public $timestamps = true;
}
