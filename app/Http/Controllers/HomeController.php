<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the Musashi homepage.
     */
    public function index()
    {
        // Latest news items for carousel (up to 10 as requested)
        $latestNews = News::published()
            ->latest('published_at')
            ->take(10)
            ->get();

        // Featured products across categories
        $featuredProducts = Product::featured()
            ->ordered()
            ->take(6)
            ->get();

        // Board of Directors for home page showcase
        $directors = \App\Models\Director::ordered()->get();

        return view('pages.home', compact('latestNews', 'featuredProducts', 'directors'));
    }
}
