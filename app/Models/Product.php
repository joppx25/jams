<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'product_size_id',
        'supplier_price',
        'price',
        'color',
        'quantity',
        'thumbnail_url',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function productSize()
    {
        return $this->belongsTo(ProductSize::class);
    }
}
