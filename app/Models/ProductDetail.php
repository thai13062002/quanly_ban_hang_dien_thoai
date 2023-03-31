<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductDetail extends Model
{
    use HasFactory;
    protected $table = 'product_detail';
    protected $fillable = [
        'product_id',
        'capacity',
        'price_import',
        'price_sell',
    ];
    public function ProductDetailColor()
    {
        return $this->hasMany(ColorProductDetail::class, 'product_id', 'id');
    }
    // public static function getListProductDetail()
    // {
    //     return self::join('color_product_detail', 'product_detail.id', '=', 'color_product_detail.product_id')
    //         ->select(DB::raw('product_detail.*,color_product_detail.quantity'))->gropBy('product_detail.')
    //         ->get()->toArray();
    // }
    public function Img()
    {
        return $this->morphMany(Image::class, 'object', 'type');
    }
    public function Color()
    {
        return $this->hasManyThrough(Color::class, ColorProductDetail::class, 'product_id', 'id', 'id', 'color_id');
    }
    public function ColorDetail()
    {
        return $this->hasMany(ColorProductDetail::class, 'product_id', 'id')->with('Color');
    }
}
