<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konum extends Model
{
    protected $table = 'konum';
    use HasFactory;
    protected $fillable =[
        'konum_adi',
    ];

    public function neredenTransfers()
    {
        return $this->hasMany(Transfer::class, 'nereden_id','id');
    }

    public function nereyeTransfers()
    {
        return $this->hasMany(Transfer::class, 'nereye_id','id');
    }
}
