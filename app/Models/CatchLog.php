<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatchLog extends Model
{
    protected $fillable = ['user_id', 'image', 'caption'];

    // Quan hệ: Bài đăng thuộc về 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ: Bài đăng tag nhiều sản phẩm
    public function products()
    {
        return $this->belongsToMany(Product::class, 'catch_log_product');
    }
}
