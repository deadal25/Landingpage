@extends('admin.layout')

@section('title', 'Create News Article')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">Article Publishing</span>
            </div>
            <h1 class="text-2xl font-black text-black">Create News Article</h1>
            <p class="text-xs text-slate-500 mt-1">Publish a new press release or corporate milestone.</p>
        </div>
        <a href="{{ route('admin.news.index') }}" class="text-xs font-medium text-slate-500 hover:text-musashi-red">&larr; Back to News</a>
    </div>

    <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" class="p-8 rounded-2xl bg-white border border-slate-200 space-y-6 shadow-xs">
        @csrf

        <div class="space-y-4">
            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Title *</label>
                <input type="text" name="title" required value="{{ old('title') }}" placeholder="Article headline" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black placeholder-slate-400 focus:outline-none focus:border-musashi-red shadow-xs">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Category *</label>
                    <select name="category" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">
                        <option value="Partnership">Partnership</option>
                        <option value="Corporate">Corporate</option>
                        <option value="Global Business">Global Business</option>
                        <option value="Exhibition">Exhibition</option>
                        <option value="Sustainability">Sustainability</option>
                    </select>
                </div>

                <div>
                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Publish Date</label>
                    <input type="date" name="published_at" value="{{ old('published_at', date('Y-m-d')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">
                </div>
            </div>

            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Excerpt (Summary) *</label>
                <textarea name="excerpt" rows="2" placeholder="Brief 1-2 sentence lead summary..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black placeholder-slate-400 focus:outline-none focus:border-musashi-red shadow-xs">{{ old('excerpt') }}</textarea>
            </div>

            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Full Article Content *</label>
                <textarea name="content" rows="8" required placeholder="Full body content of the press release..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black placeholder-slate-400 focus:outline-none focus:border-musashi-red shadow-xs">{{ old('content') }}</textarea>
            </div>

            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Featured Image (Optional)</label>
                <input type="file" name="image" accept="image/*" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-600 file:mr-3 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:bg-white file:text-slate-800 hover:file:bg-slate-100 shadow-xs">
            </div>

            <div class="flex items-center gap-2 pt-2">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" class="rounded border-slate-300 text-musashi-red focus:ring-0">
                <label for="is_featured" class="text-xs text-slate-700 cursor-pointer">Highlight as Featured Article on homepage and news top</label>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.news.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-500 hover:text-black">Cancel</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-xs transition-all">Save Article</button>
        </div>
    </form>
</div>
@endsection
