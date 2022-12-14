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
        'price',
        'image',
        'category_id',
        'brand_id',
        'product_quantity',
        'description'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
