<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $product= Product::all();
    //     return view('admin/Product/viewProduct', compact('product'));
    // }
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.Product.viewproduct', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $categories=Category::all();
       return view('admin.Product.addProduct', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'product_quantity' => 'required|integer',
            'category' => 'required',
            'product_description' => 'nullable|string',
            'product_photo' => 'image|max:2048',
        ]);
    
        if ($request->hasFile('product_photo')) {
            $photo = $request->file('product_photo');
            $photoName ="uploads/". time().'.'.$photo->extension();
            $photo->move(public_path('uploads'), $photoName);
        } else {
            $photoName = null;
        }
    
        Product::create([
            'name' => $request->product_name,
            'price' => $request->product_price,
            'quantity' => $request->product_quantity,
            'category_id' => $request->category,
            'description' => $request->product_description,
            'photo' => $photoName,
        ]);
    
        return redirect()->route('products.view')->with('success', 'Product added successfully');
    }
    

    /** 
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $product = Product::findOrFail($id);
    //     return view('details', compact('product'));
    // }
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        
        // Get related products from the same category
        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        
        return view('details', compact('product', 'relatedProducts'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
    
        return view('admin.Product.editProduct', compact('product', 'categories'));
    }

   
    
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
    
        $product->update([
            'name' => $request->product_name,
            'price' => $request->product_price,
            'quantity' => $request->product_quantity,
            'description' => $request->product_description,
            'category' => $request->category,
            'photo' => $request->product_photo ?? $product->photo, // optional update
        ]);
    
        return redirect()->route('products.view')->with('success', 'Product updated successfully!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.view')->with('success', 'Product deleted successfully!');
    }
    
public function home()
{
    $latestProducts = Product::latest()->take(10)->get();
    return view('userhome', compact('latestProducts'));
}
}
