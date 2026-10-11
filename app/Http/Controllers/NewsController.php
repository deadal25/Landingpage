<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of news articles with categories and pagination.
     */
    public function index(Request $request)
    {
        $query = News::published()->latest('published_at');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $featuredNews = News::published()->featured()->latest('published_at')->first();
        $newsList = $query->paginate(6)->withQueryString();

        $categories = News::published()->distinct()->pluck('category')->filter()->values();

        return view('pages.news.index', compact('newsList', 'featuredNews', 'categories'));
    }

    /**
     * Display the specified news article.
     */
    public function show($slug)
    {
        $news = News::published()->where('slug', $slug)->firstOrFail();
        
        $recentNews = News::published()
            ->where('id', '!=', $news->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.news.show', compact('news', 'recentNews'));
    }
}
