@extends('admin.layout')

@section('title', 'Edit Board of Director Member')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">Executive Editor</span>
            </div>
            <h1 class="text-2xl font-black text-black">Edit Director</h1>
            <p class="text-xs text-slate-500 mt-1">Update profile for "{{ $director->name }}"</p>
        </div>
        <a href="{{ route('admin.directors.index') }}" class="text-xs font-medium text-slate-500 hover:text-musashi-red">&larr; Back to Directors</a>
    </div>

    <form method="POST" action="{{ route('admin.directors.update', $director) }}" enctype="multipart/form-data" class="p-8 rounded-2xl bg-white border border-slate-200 space-y-6 shadow-xs">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Full Name *</label>
                <input type="text" name="name" required value="{{ old('name', $director->name) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Title / Designation *</label>
                    <input type="text" name="title" required value="{{ old('title', $director->title) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">
                </div>

                <div>
                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Display Order</label>
                    <input type="number" name="order" value="{{ old('order', $director->order) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">
                </div>
            </div>

            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Biography / Executive Overview</label>
                <textarea name="bio" rows="4" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">{{ old('bio', $director->bio) }}</textarea>
            </div>

            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Current Photo</label>
                @if($director->photo)
                    <img src="{{ asset($director->photo) }}" alt="" class="w-20 h-24 object-cover rounded-lg mb-2 border border-slate-200">
                @endif
                <input type="file" name="photo" accept="image/*" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-600 file:mr-3 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:bg-white file:text-slate-800 hover:file:bg-slate-100 shadow-xs">
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.directors.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-500 hover:text-black">Cancel</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-xs transition-all">Update Director</button>
        </div>
    </form>
</div>
@endsection
