<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AracTuru extends Model
{
    use HasFactory;
    protected $table = 'arac_turu';

    protected $fillable = [
        'arac_tur_adi',
        'koltuk_sayisi',
        'arac_resim'
    ];

    public function ozellikler()
    {
        return $this->hasMany(AracOzellik::class, 'arac_id');
    }
    public function transfer(){
        return $this->hasMany(Transfer::class,'arac_turu_id');
    }
}
