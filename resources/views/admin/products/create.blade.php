@extends('admin.layout')

@section('title', 'Add New Product')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">Product Registration</span>
            </div>
            <h1 class="text-2xl font-black text-black">Add New Product</h1>
            <p class="text-xs text-slate-500 mt-1">Register a new precision drivetrain part or e-Axle module.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-xs font-medium text-slate-500 hover:text-musashi-red">&larr; Back to Products</a>
    </div>

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="p-8 rounded-2xl bg-white border border-slate-200 space-y-6 shadow-xs">
        @csrf

        <div class="space-y-4">
            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Product Name *</label>
                <input type="text" name="name" required value="{{ old('name') }}" placeholder="e.g. 2W Transmission Gear" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Category *</label>
                    <select name="category" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">
                        <option value="2-Wheelers">2-Wheelers</option>
                        <option value="4-Wheelers">4-Wheelers</option>
                        <option value="EV / Future Mobility">EV / Future Mobility</option>
                    </select>
                </div>

                <div>
                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Display Order</label>
                    <input type="number" name="order" value="{{ old('order', 0) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">
                </div>

                <div class="flex items-end pb-2">
                    <label class="flex items-center gap-2 text-xs text-slate-700 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" class="rounded border-slate-300 text-musashi-red focus:ring-0">
                        <span>Featured on Homepage</span>
                    </label>
                </div>
            </div>

            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Description</label>
                <textarea name="description" rows="3" placeholder="Brief technical summary of the component..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Key Features (One per line)</label>
                <textarea name="features" rows="3" placeholder="Precision cold forging technology&#10;Low vibration tooth profile&#10;High fatigue endurance" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">{{ old('features') }}</textarea>
            </div>

            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Specifications (Material, Hardness, Dimensions)</label>
                <input type="text" name="specifications" value="{{ old('specifications') }}" placeholder="Material: SCM420H | Heat Treatment: Carburized & Quenched" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">
            </div>

            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Product Image</label>
                <input type="file" name="image" accept="image/*" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-600 file:mr-3 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:bg-white file:text-slate-800 hover:file:bg-slate-100 shadow-xs">
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-500 hover:text-black">Cancel</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-xs transition-all">Save Product</button>
        </div>
    </form>
</div>
@endsection
