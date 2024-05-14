<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',
        'address',
        'support_phone',
        'email',
        'favicon',
        'meta_title',
        'meta_author',
        'meta_keyword',
        'meta_description',
        'analytic'
    ];
    public $timestamps = true;
}
