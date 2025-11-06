<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Các cột được phép gán hàng loạt
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];

    // Một sản phẩm thuộc về một danh mục
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Một sản phẩm có thể nằm trong nhiều OrderItem (khi có đơn hàng)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // (Tuỳ chọn) Kiểm tra còn hàng hay không
    public function inStock(): bool
    {
        return $this->stock > 0;
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function getTotalStock()
    {
        return $this->variants->sum('stock');
    }
    public function getMinPrice()
    {
        // Nếu variants đã load sẵn (Eager Loaded)
        if ($this->relationLoaded('variants')) {
            return $this->variants->min('price') ?? 0;
        }

        // Nếu chưa load thì query trực tiếp từ DB
        return $this->variants()->min('price') ?? 0;
    }
}
