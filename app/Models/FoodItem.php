<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    protected $fillable = ['name', 'default_price', 'full_price', 'half_price'];
    
    // Define any relationships if needed
}
