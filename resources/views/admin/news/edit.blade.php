@extends('admin.layout')

@section('title', 'Edit News Article')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">Article Editor</span>
            </div>
            <h1 class="text-2xl font-black text-black">Edit News Article</h1>
            <p class="text-xs text-slate-500 mt-1">Update details for "{{ $news->title }}"</p>
        </div>
        <a href="{{ route('admin.news.index') }}" class="text-xs font-medium text-slate-500 hover:text-musashi-red">&larr; Back to News</a>
    </div>

    <form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" class="p-8 rounded-2xl bg-white border border-slate-200 space-y-6 shadow-xs">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Title *</label>
                <input type="text" name="title" required value="{{ old('title', $news->title) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Category *</label>
                    <select name="category" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">
                        <option value="Partnership" {{ $news->category === 'Partnership' ? 'selected' : '' }}>Partnership</option>
                        <option value="Corporate" {{ $news->category === 'Corporate' ? 'selected' : '' }}>Corporate</option>
                        <option value="Global Business" {{ $news->category === 'Global Business' ? 'selected' : '' }}>Global Business</option>
                        <option value="Exhibition" {{ $news->category === 'Exhibition' ? 'selected' : '' }}>Exhibition</option>
                        <option value="Sustainability" {{ $news->category === 'Sustainability' ? 'selected' : '' }}>Sustainability</option>
                    </select>
                </div>

                <div>
                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Publish Date</label>
                    <input type="date" name="published_at" value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d') : '') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">
                </div>
            </div>

            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Excerpt *</label>
                <textarea name="excerpt" rows="2" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">{{ old('excerpt', $news->excerpt) }}</textarea>
            </div>

            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Full Article Content *</label>
                <textarea name="content" rows="8" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">{{ old('content', $news->content) }}</textarea>
            </div>

            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Current Image</label>
                @if($news->image)
                    <img src="{{ asset($news->image) }}" alt="" class="w-24 h-16 object-cover rounded-lg mb-2 border border-slate-200">
                @endif
                <input type="file" name="image" accept="image/*" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-600 file:mr-3 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:bg-white file:text-slate-800 hover:file:bg-slate-100 shadow-xs">
            </div>

            <div class="flex items-center gap-2 pt-2">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ $news->is_featured ? 'checked' : '' }} class="rounded border-slate-300 text-musashi-red focus:ring-0">
                <label for="is_featured" class="text-xs text-slate-700 cursor-pointer">Highlight as Featured Article</label>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.news.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-500 hover:text-black">Cancel</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-xs transition-all">Update Article</button>
        </div>
    </form>
</div>
@endsection
