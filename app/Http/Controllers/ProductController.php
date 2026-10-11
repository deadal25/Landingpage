<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display product catalog with filtering and search.
     */
    public function index(Request $request)
    {
        $query = Product::query()->ordered();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('specifications', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(9)->withQueryString();

        $categories = [
            '2-Wheelers' => '2-Wheelers Engine & Transmission',
            '4-Wheelers' => '4-Wheelers Transmission & Drivetrain',
            'EV / Future Mobility' => 'Electric Mobility & e-Axle Solutions',
        ];

        return view('pages.product.index', compact('products', 'categories'));
    }

    /**
     * Display product details.
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->ordered()
            ->take(3)
            ->get();

        return view('pages.product.show', compact('product', 'relatedProducts'));
    }
}
