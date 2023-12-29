<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Konum;
use App\Models\AracTuru;
class Transfer extends Model
{
    protected $table = 'transfer';
    use HasFactory;
    protected $fillable = [
        'nereden_id',
        'nereye_id',
        'fiyat',
        'arac_turu_id',
    ];

    public function nereden()
    {
        return $this->belongsTo(Konum::class, 'nereden_id','id');
    }

    public function nereye()
    {
        return $this->belongsTo(Konum::class, 'nereye_id','id');
    }

    public function aracTur()
    {
        return $this->belongsTo(AracTuru::class, 'arac_turu_id','id');
    }

}
