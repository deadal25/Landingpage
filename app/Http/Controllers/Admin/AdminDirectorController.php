<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Director;
use Illuminate\Http\Request;

class AdminDirectorController extends Controller
{
    public function index()
    {
        $directors = Director::ordered()->get();
        return view('admin.directors.index', compact('directors'));
    }

    public function create()
    {
        return view('admin.directors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'order' => 'integer',
            'photo' => 'nullable|image|max:2048',
        ]);

        $validated['order'] = $request->input('order', 0);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('bod', 'public');
            $validated['photo'] = '/storage/' . $path;
        }

        Director::create($validated);

        return redirect()->route('admin.directors.index')->with('success', 'Board of Director member created successfully!');
    }

    public function edit(Director $director)
    {
        return view('admin.directors.edit', compact('director'));
    }

    public function update(Request $request, Director $director)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'order' => 'integer',
            'photo' => 'nullable|image|max:2048',
        ]);

        $validated['order'] = $request->input('order', 0);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('bod', 'public');
            $validated['photo'] = '/storage/' . $path;
        }

        $director->update($validated);

        return redirect()->route('admin.directors.index')->with('success', 'Board of Director member updated successfully!');
    }

    public function destroy(Director $director)
    {
        $director->delete();
        return redirect()->route('admin.directors.index')->with('success', 'Board of Director member removed successfully!');
    }
}
