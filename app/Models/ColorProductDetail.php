<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorProductDetail extends Model
{
    use HasFactory;
    protected $table = 'color_product_detail';
    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'color_id',
        'quantity',
    ];
    public function Color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }
    public function Img()
    {
        return $this->morphMany(Image::class, 'object', 'type');
    }
}
