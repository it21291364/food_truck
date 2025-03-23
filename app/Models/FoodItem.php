<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    protected $fillable = [
        'name',
        'default_price',
        'full_price',
        'half_price',
    ];

    // If you have relationships later (e.g., an order history), define them here.
}

