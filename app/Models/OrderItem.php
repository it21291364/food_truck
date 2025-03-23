<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'food_item_id',
        'size',
        'unit_price',
        'quantity',
        'subtotal',
    ];

    /**
     * Each OrderItem belongs to one Order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Each OrderItem also belongs to a FoodItem.
     */
    public function foodItem()
    {
        return $this->belongsTo(FoodItem::class);
    }
}

