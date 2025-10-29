<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    // Giỏ hàng thuộc về 1 người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mỗi dòng giỏ hàng tương ứng với 1 sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Helper: tính tổng tiền của dòng giỏ hàng
    public function getTotalAttribute()
    {
        return $this->product->price * $this->quantity;
    }
}
