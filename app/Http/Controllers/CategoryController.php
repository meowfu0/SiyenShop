<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{

    public function add(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'category_name' => 'required|string|max:20',
        ]);

        try {
            // Insert the category into the database
            DB::table('categories')->insert([
                'category_name' => $validated['category_name'],
            ]);

            // Return a JSON response for AJAX
            return response()->json(['success' => true, 'message' => 'New category added successfully.']);
        } catch (\Exception $e) {
            // Log the error and return with an error message
            Log::error('Category insertion failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to add category.']);
        }
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        // Validate input data
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Update the category
        $category->category_name = $validated['category_name'];
        $category->save();

        return redirect()->back();
    }


    // Delete category
    public function destroy($id)
    {
        // Find the category by ID
        $category = Category::find($id);
    
        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Category not found.'], 404);
        }
    
        // Delete the category
        $category->delete();
    
        return redirect()->back();
    }
}
