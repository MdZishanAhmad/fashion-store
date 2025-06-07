<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\RedirectController;


class HomeController extends Controller
{
    public function showHome()
    {
        return view("components.index");
    }
    public function user()
    {
        return view("components.index");
    }
    public function index()
    {
        // Get the 6 most recent products
        $recentProducts = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        
        return view("index", compact('recentProducts'));
    }
    public function cart()
    {
        return view("shopping-cart");
    }
    public function shop(Request $request)
{
    $query = Product::query();

    // Search
    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Category filter
    if ($request->has('category')) {
        $categoryId = $request->category;
        $category = Category::find($categoryId);
        
        if ($category) {
            if ($category->children->count() > 0) {
                // If it's a parent category, get all products from this category and its children
                $childIds = $category->children->pluck('id')->push($categoryId);
                $query->whereIn('category_id', $childIds);
            } else {
                // If it's a child category, get only products from this category
                $query->where('category_id', $categoryId);
            }
        }
    }


    // Sorting
    switch ($request->sort) {
        case 'price_asc':
            $query->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('price', 'desc');
            break;
                default:
            $query->orderBy('created_at', 'desc');
    }

    $products = $query->paginate(12);
    $categories = Category::with('children')
        ->whereNull('parent_id')
        ->get();

    return view("shop", compact('categories', 'products'));

    }
    // public function checkout(){

    //     return view("checkout");
    // }
    public function shopdetails()
    {
        return view("shop-details");
    }

    public function contacts()
    {
        return view("contact");
    }


    // public function card(){
    //     $products = Product::all();
    //     return view('shop', compact('products'));

    // }



}
