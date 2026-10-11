@extends('admin.layout')

@section('title', 'Manage Products')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">Product Inventory</span>
            </div>
            <h1 class="text-2xl font-black text-black">Automotive Products Catalog</h1>
            <p class="text-xs text-slate-500 mt-1">Manage transmission parts, camshafts, and EV assemblies.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-xs transition-all">
            <span>+ Add Product</span>
        </a>
    </div>

    <!-- Table Card -->
    <div class="rounded-2xl bg-white border border-slate-200 overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 font-mono uppercase text-[11px]">
                    <tr>
                        <th class="p-4">Image</th>
                        <th class="p-4">Product Name</th>
                        <th class="p-4">Category</th>
                        <th class="p-4">Order</th>
                        <th class="p-4">Featured</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @foreach($products as $prod)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="p-4">
                                <img src="{{ asset($prod->image ?? 'images/logo.png') }}" alt="" class="w-12 h-9 object-cover rounded-lg bg-slate-100 border border-slate-200">
                            </td>
                            <td class="p-4">
                                <strong class="text-black block font-semibold max-w-sm line-clamp-1">{{ $prod->name }}</strong>
                                <span class="text-slate-400 text-[10px] font-mono">{{ $prod->slug }}</span>
                            </td>
                            <td class="p-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-red-50 text-musashi-red border border-red-200">
                                    {{ $prod->category }}
                                </span>
                            </td>
                            <td class="p-4 font-mono text-slate-600">{{ $prod->order }}</td>
                            <td class="p-4">
                                @if($prod->is_featured)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Yes</span>
                                @else
                                    <span class="text-slate-400">No</span>
                                @endif
                            </td>
                            <td class="p-4 text-right space-x-2">
                                <a href="{{ route('admin.products.edit', $prod) }}" class="px-3 py-1.5 rounded-lg text-slate-700 hover:text-black bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-colors font-medium">Edit</a>
                                <form method="POST" action="{{ route('admin.products.destroy', $prod) }}" class="inline-block" onsubmit="return confirm('Delete product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 rounded-lg text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 border border-red-200 transition-colors font-medium">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
