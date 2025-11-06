<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_url',
        'is_thumbnail',
        'sort_order',
    ];

    // 🔗 Mỗi ảnh thuộc về một sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
