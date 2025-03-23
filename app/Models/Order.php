<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_date',
        'total_amount',
    ];

    /**
     * An Order has many OrderItems.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Optionally, link to the User (cashier/admin) who created the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

