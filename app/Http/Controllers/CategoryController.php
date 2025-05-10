<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return view('admin/Category/category', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create([

            'category' => $request->category,
            'parent_id' => $request->parent_id ? $request->parent_id : null, // Handle null parent_id
        ]);

        return redirect()->route('category')->with('success', 'Category Added Successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:category,id'
        ]);

        $category = Category::findOrFail($id);
        
        // Prevent setting a category as its own parent
        if ($request->parent_id == $id) {
            return back()->with('error', 'A category cannot be its own parent');
        }

        $category->update([
            'category' => $request->category,
            'parent_id' => $request->parent_id ?: null,
        ]);

        return redirect()->route('category')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    try{
        $category = Category::findOrFail($id);
        
        // Check if category has children
        if ($category->children()->count() > 0) {
            return back()->with('error', 'Cannot delete category with subcategories');
        }
        
        // Check if category has products
        if ($category->products()->count() > 0) {
            return back()->with('error', 'Cannot delete category with associated products');
        }

        $category->delete();

        return redirect()->route('category')->with('success', 'Category Deleted Successfully');
    }catch(\Exception $e){
        return back()->with('error', $e->getMessage());
    }
    }
}
