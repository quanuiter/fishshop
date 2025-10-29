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
}
