<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    // Các cột được phép gán hàng loạt
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    // Quan hệ: 1 Category có nhiều Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // (Tuỳ chọn) Tự sinh slug nếu chưa có khi tạo mới
    protected static function booted()
    {
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
}
