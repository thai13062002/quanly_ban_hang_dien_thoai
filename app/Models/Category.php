<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_id'];
    public function SubCategory()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->with('SubCategory');
    }
    public function categoryParent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
