<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; // Make sure to import your Category model

class CategoryController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->category_name = $request->name;
        $category->save();

        return response()->json(['success' => true]);
    }
}