<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $table = "portfolio";
    protected $fillable=[
        'category_id',
        'description',
        'image_url',
    ];
    public function category()
    {
        return $this->belongsTo(PortfolioCategory::class, 'category_id');
    }
}
