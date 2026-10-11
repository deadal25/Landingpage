@extends('admin.layout')

@section('title', 'Dashboard Overview')

@section('content')
<div class="space-y-8">
    
    <!-- Header title -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">Superadmin Musashi Control</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-black">System Overview</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Management summary for PT Musashi Auto Parts Indonesia web portal.</p>
        </div>
        <div class="flex items-center gap-2 bg-emerald-50 px-3 py-1.5 rounded-full border border-emerald-200">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="text-xs font-mono font-bold text-emerald-800">All Systems Operational</span>
        </div>
    </div>

    <!-- Superadmin Musashi Visual CMS Banner -->
    <div class="p-6 rounded-2xl bg-gradient-to-r from-red-50 via-white to-slate-50 border border-red-200 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 shadow-xs">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-musashi-red text-white flex items-center justify-center font-black text-sm shadow-xs">
                M
            </div>
            <div>
                <h2 class="text-sm font-bold text-slate-900">Superadmin Musashi - Landing Page CMS (/SuperadminMusashi)</h2>
                <p class="text-xs text-slate-500">Ubah isi landing page, hero video slider 3 scene, 4 domain pilar bisnis, teknologi & monozukuri dalam 3 bahasa (ID, EN, JP).</p>
            </div>
        </div>
        <a href="{{ route('superadmin.index') }}" class="px-5 py-2.5 rounded-full bg-musashi-red hover:bg-musashi-darkred text-white text-xs font-bold uppercase tracking-wider transition-all flex items-center gap-2 shadow-xs whitespace-nowrap">
            <span>Buka Superadmin Musashi</span>
            <span>&rarr;</span>
        </a>
    </div>

    <!-- Stat Metric Cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs space-y-1">
            <span class="text-xs font-mono text-slate-500 block uppercase font-semibold">News Posts</span>
            <span class="text-2xl font-black text-black font-mono">{{ $stats['news_count'] }}</span>
        </div>

        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs space-y-1">
            <span class="text-xs font-mono text-slate-500 block uppercase font-semibold">Products</span>
            <span class="text-2xl font-black text-musashi-red font-mono">{{ $stats['products_count'] }}</span>
        </div>

        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs space-y-1">
            <span class="text-xs font-mono text-slate-500 block uppercase font-semibold">Job Openings</span>
            <span class="text-2xl font-black text-black font-mono">{{ $stats['careers_count'] }}</span>
        </div>

        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs space-y-1">
            <span class="text-xs font-mono text-slate-500 block uppercase font-semibold">Applicants</span>
            <span class="text-2xl font-black text-emerald-700 font-mono">{{ $stats['applications_count'] }}</span>
        </div>

        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs space-y-1">
            <span class="text-xs font-mono text-slate-500 block uppercase font-semibold">Inquiries</span>
            <span class="text-2xl font-black text-blue-700 font-mono">{{ $stats['messages_count'] }}</span>
        </div>

        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs space-y-1">
            <span class="text-xs font-mono text-slate-500 block uppercase font-semibold">Directors</span>
            <span class="text-2xl font-black text-slate-900 font-mono">{{ $stats['directors_count'] }}</span>
        </div>
    </div>

    <!-- 2 Columns: Recent Applications & Recent Inquiries -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Recent Applications -->
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="text-base font-bold text-black">Recent Job Applicants</h3>
                <a href="{{ route('admin.careers.applications') }}" class="text-xs font-semibold text-musashi-red hover:underline">View All &rarr;</a>
            </div>

            @if($recentApplications->isEmpty())
                <p class="text-xs text-slate-400 py-6 text-center">No career applications received yet.</p>
            @else
                <div class="divide-y divide-slate-100 text-xs">
                    @foreach($recentApplications as $app)
                        <div class="py-3 flex items-center justify-between gap-4">
                            <div>
                                <strong class="text-black block font-semibold">{{ $app->full_name }}</strong>
                                <span class="text-slate-500 text-[11px]">{{ $app->career->title ?? 'General' }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold {{ $app->status === 'Pending' ? 'bg-amber-50 text-amber-800 border border-amber-200' : 'bg-emerald-50 text-emerald-800 border border-emerald-200' }}">
                                    {{ $app->status }}
                                </span>
                                <span class="text-slate-400 text-[10px] font-mono">{{ $app->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Recent Inquiries -->
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="text-base font-bold text-black">Recent Contact Inquiries</h3>
                <span class="text-xs text-slate-400 font-mono">Latest Messages</span>
            </div>

            @if($recentMessages->isEmpty())
                <p class="text-xs text-slate-400 py-6 text-center">No contact messages received yet.</p>
            @else
                <div class="divide-y divide-slate-100 text-xs">
                    @foreach($recentMessages as $msg)
                        <div class="py-3 space-y-1">
                            <div class="flex items-center justify-between">
                                <strong class="text-black font-semibold">{{ $msg->name }} <span class="text-slate-500 font-normal">({{ $msg->company ?? 'Individual' }})</span></strong>
                                <span class="text-slate-400 text-[10px] font-mono">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="text-musashi-red text-[11px] font-mono font-medium">{{ $msg->subject }}</div>
                            <p class="text-slate-600 line-clamp-1 text-[11px]">{{ $msg->message }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

    <!-- Quick Action Links -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <a href="{{ route('admin.news.create') }}" class="p-4 rounded-xl bg-white border border-slate-200 hover:border-musashi-red shadow-xs transition-colors flex items-center justify-between group">
            <span class="text-xs font-semibold text-slate-800 group-hover:text-musashi-red">+ Create News Article</span>
            <span class="text-musashi-red font-bold">&rarr;</span>
        </a>

        <a href="{{ route('admin.products.create') }}" class="p-4 rounded-xl bg-white border border-slate-200 hover:border-musashi-red shadow-xs transition-colors flex items-center justify-between group">
            <span class="text-xs font-semibold text-slate-800 group-hover:text-musashi-red">+ Add New Product</span>
            <span class="text-musashi-red font-bold">&rarr;</span>
        </a>

        <a href="{{ route('admin.careers.create') }}" class="p-4 rounded-xl bg-white border border-slate-200 hover:border-musashi-red shadow-xs transition-colors flex items-center justify-between group">
            <span class="text-xs font-semibold text-slate-800 group-hover:text-musashi-red">+ Post Job Vacancy</span>
            <span class="text-musashi-red font-bold">&rarr;</span>
        </a>

        <a href="{{ route('admin.directors.create') }}" class="p-4 rounded-xl bg-white border border-slate-200 hover:border-musashi-red shadow-xs transition-colors flex items-center justify-between group">
            <span class="text-xs font-semibold text-slate-800 group-hover:text-musashi-red">+ Add Board Member</span>
            <span class="text-musashi-red font-bold">&rarr;</span>
        </a>
    </div>

</div>
@endsection
