<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'is_selling',
        'is_outstanding',
        'cat_id',
        'brand_id',
        'pice_sell',
        'price_import',
    ];
    protected $appends = ['quantity'];
    public function getQuantityAttribute()
    {
        $totalQuantity = array_sum(array_column(ProductDetail::where('product_detail.product_id', $this->id)
            ->join('color_product_detail', 'color_product_detail.product_id', 'product_detail.id')
            ->get('quantity')->toArray(), 'quantity'));
        return $totalQuantity;
    }
    public function Img()
    {
        return $this->morphMany(Image::class, 'object', 'type');
    }
    public function Brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    public function Category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }
    public function ProductDetail()
    {
        return $this->hasMany(ProductDetail::class, 'product_id', 'id')->with('Img', 'ColorDetail')->whereHas('ColorDetail');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
