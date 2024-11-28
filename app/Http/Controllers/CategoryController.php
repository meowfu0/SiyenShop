<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        // Validate the category name (ensure it's not empty and is a string)
        $validated = $request->validate([
            'category_name' => 'required|string|max:255'
        ]);

        // Normalize the input category name to lowercase
        $normalizedCategoryName = strtolower($validated['category_name']);

        // Check if the category already exists (case-insensitive)
        $existingCategory = Category::whereRaw('LOWER(name) = ?', [$normalizedCategoryName])->first();

        if ($existingCategory) {
            return back()->withErrors(['category_name' => 'Category already exists with a similar name.']);
        }

        // If the category doesn't exist, save it to the database
        Category::create([
            'name' => $validated['category_name']
        ]);

        return redirect()->route('categories.index')->with('message', 'Category added successfully.');
    }
}
