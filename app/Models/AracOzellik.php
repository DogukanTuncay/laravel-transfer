<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AracOzellik extends Model
{
    use HasFactory;
    protected $table = 'arac_ozellik';

    protected $fillable = [
        'arac_id',
        'ozellik'
    ];

    public function aracTuru()
    {
        return $this->belongsTo(AracTuru::class, 'arac_id','id');
    }
}
