<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    protected $fillable = [
        'user_id',
        'promotion_id',
        'total_amount',
        'discount_amount',
        'final_amount',
        'status',
        'name',
        'phone',
        'address',
        'payment_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}
?>