<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'name',
        'phone',
        'address',
        'payment_method',
    ];

    // 🔗 Quan hệ: đơn hàng thuộc về 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔗 Quan hệ: 1 đơn hàng có nhiều sản phẩm chi tiết
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
