<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display Contact Us page with plant maps and inquiry form.
     */
    public function index()
    {
        return view('pages.contact.index');
    }

    /**
     * Handle contact form submission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        ContactMessage::create($validated);

        return redirect()->route('contact.index')
            ->with('success', 'Thank you for reaching out to PT. Musashi Auto Parts Indonesia! Your inquiry has been received and our corporate affairs team will respond promptly.');
    }
}
