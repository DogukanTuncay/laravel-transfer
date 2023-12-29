<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rezervasyon extends Model
{
    use HasFactory;
    protected $table = 'rezervasyon';
    protected $fillable = [
        'nereden_id',
        'nereye_id',
        'yetiskin',
        'cocuk',
        'date',
        'hour',
        'parabirimi',
        'fiyat',
        'arac_turu_id',
        'isim',
        'soyisim',
        'phone',
    ];

    public function aracTur()
    {

        return $this->belongsTo(AracTuru::class, 'arac_turu_id', 'id');

    }

    public function nereden()
    {

        return $this->belongsTo(Konum::class, 'nereden_id');

    }

    public function nereye()
    {

        return $this->belongsTo(Konum::class, 'nereye_id');

    }
}
