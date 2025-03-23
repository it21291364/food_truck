<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use Illuminate\Http\Request;

class FoodItemController extends Controller
{
    // Restrict access to admin only (via middleware in routes or constructor)
    
    public function index()
    {
        $foodItems = FoodItem::all();
        return view('admin.food_items.index', compact('foodItems'));
    }

    public function create()
    {
        return view('admin.food_items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'default_price' => 'nullable|numeric',
            'full_price' => 'nullable|numeric',
            'half_price' => 'nullable|numeric',
        ]);

        FoodItem::create($request->all());
        return redirect()->route('food-items.index')->with('success', 'Food item added successfully.');
    }

    public function show(FoodItem $foodItem)
    {
        return view('admin.food_items.show', compact('foodItem'));
    }

    public function edit(FoodItem $foodItem)
    {
        return view('admin.food_items.edit', compact('foodItem'));
    }

    public function update(Request $request, FoodItem $foodItem)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'default_price' => 'nullable|numeric',
            'full_price' => 'nullable|numeric',
            'half_price' => 'nullable|numeric',
        ]);

        $foodItem->update($request->all());
        return redirect()->route('food-items.index')->with('success', 'Food item updated successfully.');
    }

    public function destroy(FoodItem $foodItem)
    {
        $foodItem->delete();
        return redirect()->route('food-items.index')->with('success', 'Food item deleted successfully.');
    }
}

