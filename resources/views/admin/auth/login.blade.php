<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Superadmin Musashi Login - PT Musashi Auto Parts Indonesia</title>
    
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F4F6F8] text-slate-800 min-h-screen flex items-center justify-center p-4 font-sans antialiased selection:bg-musashi-red selection:text-white">

    <div class="max-w-md w-full bg-white rounded-2xl p-8 sm:p-10 border border-slate-200 shadow-md relative">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-slate-50 border border-slate-200 mb-4 shadow-xs">
                <img src="{{ asset('images/logo.png') }}" alt="Musashi Logo" class="w-10 h-10 object-contain">
            </div>
            <div class="flex items-center justify-center gap-2">
                <span class="text-2xl font-black text-black tracking-tighter uppercase font-sans">MUSASHI</span>
                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-red-50 text-musashi-red border border-red-200">SUPERADMIN</span>
            </div>
            <p class="text-xs text-slate-500 mt-1">PT Musashi Auto Parts Indonesia &bull; Superadmin Control Portal</p>
        </div>

        @if($errors->any())
            <div class="p-3 mb-6 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
            @csrf

            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Email Address</label>
                <input type="email" name="email" required value="{{ old('email', 'admin@musashi.co.id') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black placeholder-slate-400 focus:outline-none focus:border-musashi-red shadow-xs">
            </div>

            <div>
                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Password</label>
                <input type="password" name="password" required value="password" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black placeholder-slate-400 focus:outline-none focus:border-musashi-red shadow-xs">
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 text-slate-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-musashi-red focus:ring-0">
                    <span>Remember me</span>
                </label>
                <span class="text-slate-400 text-[11px] font-mono">Default: password</span>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-xs transition-all">
                Sign In to Superadmin Musashi
            </button>
        </form>

        <div class="mt-8 text-center pt-6 border-t border-slate-100">
            <a href="{{ route('home') }}" class="text-xs text-slate-500 hover:text-musashi-red transition-colors font-medium">
                &larr; Return to Public Website
            </a>
        </div>
    </div>

</body>
</html>
