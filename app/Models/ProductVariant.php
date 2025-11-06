<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'price',
        'stock',
        'color',
        'size',
        'image',
    ];

    // 🔗 Mỗi biến thể thuộc về một sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Nếu sau này có ảnh riêng cho biến thể
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
