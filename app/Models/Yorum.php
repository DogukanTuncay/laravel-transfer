<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yorum extends Model
{
    use HasFactory;
    protected $table = "yorum";
    protected $fillable =[
        'user_id',
        'rating',
        'yorum'
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id')->select('id','name');
    }
}
