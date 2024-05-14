<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'read_at',
        'user_id_send',
        'link_detail',
    ];
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id_send','id');
    }
}
