<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\CareerApplication;
use App\Models\ContactMessage;
use App\Models\Director;
use App\Models\News;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    /**
     * Display the Admin Dashboard overview.
     */
    public function index()
    {
        $stats = [
            'news_count' => News::count(),
            'products_count' => Product::count(),
            'careers_count' => Career::count(),
            'directors_count' => Director::count(),
            'applications_count' => CareerApplication::count(),
            'messages_count' => ContactMessage::count(),
        ];

        $recentApplications = CareerApplication::with('career')->latest()->take(5)->get();
        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentNews = News::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentApplications', 'recentMessages', 'recentNews'));
    }
}
