@extends('admin.layout')

@section('title', 'Manage Board of Directors')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">Executive Management</span>
            </div>
            <h1 class="text-2xl font-black text-black">Board of Directors</h1>
            <p class="text-xs text-slate-500 mt-1">Manage executive leadership profiles and bios.</p>
        </div>
        <a href="{{ route('admin.directors.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-xs transition-all">
            <span>+ Add Director</span>
        </a>
    </div>

    <!-- Table Card -->
    <div class="rounded-2xl bg-white border border-slate-200 overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 font-mono uppercase text-[11px]">
                    <tr>
                        <th class="p-4">Photo</th>
                        <th class="p-4">Full Name</th>
                        <th class="p-4">Title / Position</th>
                        <th class="p-4">Order</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @foreach($directors as $director)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="p-4">
                                <img src="{{ asset($director->photo ?? 'images/bod/asep-nugraha.jpg') }}" alt="" class="w-10 h-12 object-cover rounded-lg bg-slate-100 border border-slate-200">
                            </td>
                            <td class="p-4">
                                <strong class="text-black block font-semibold">{{ $director->name }}</strong>
                            </td>
                            <td class="p-4">
                                <span class="text-musashi-red font-semibold">{{ $director->title }}</span>
                            </td>
                            <td class="p-4 font-mono text-slate-600">{{ $director->order }}</td>
                            <td class="p-4 text-right space-x-2">
                                <a href="{{ route('admin.directors.edit', $director) }}" class="px-3 py-1.5 rounded-lg text-slate-700 hover:text-black bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-colors font-medium">Edit</a>
                                <form method="POST" action="{{ route('admin.directors.destroy', $director) }}" class="inline-block" onsubmit="return confirm('Remove director?')">
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
    </div>
</div>
@endsection
