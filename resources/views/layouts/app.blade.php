<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistem Monitoring Pengadaan Barang & Jasa') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased selection:bg-brand-500 selection:text-white" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Include Sidebar Component -->
        @include('layouts.sidebar')

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col overflow-hidden relative">
            
            <!-- Top Header -->
            <header class="bg-dark-900 border-b border-white/10 h-16 md:h-20 flex items-center justify-between px-4 sm:px-6 lg:px-8 z-30 sticky top-0 shadow-md">
                <!-- Left Side: Mobile Menu Button & Title / Desktop Greeting -->
                <div class="flex items-center gap-3 sm:gap-5 flex-1 min-w-0">
                    <button @click="sidebarOpen = true" class="md:hidden p-2 -ml-2 rounded-xl text-gray-400 hover:bg-white/10 hover:text-white focus:outline-none transition-all flex-shrink-0">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    
                    <!-- Mobile Title -->
                    <div class="md:hidden flex flex-col min-w-0 flex-1">
                        <h1 class="text-base sm:text-lg font-extrabold text-white tracking-tight leading-tight truncate">Monitoring Pengadaan</h1>
                        <span class="text-[10px] text-brand-400 font-bold uppercase tracking-wider truncate">Barang & Jasa</span>
                    </div>

                    <!-- Desktop Greeting -->
                    <div class="hidden md:flex items-center gap-4">
                        <div class="flex flex-col justify-center">
                            <h2 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Selamat datang kembali</h2>
                            <div class="flex items-center gap-2 mt-0.5">
                                <p class="text-lg font-extrabold text-white leading-tight">{{ Auth::user()->name }}</p>
                                <span class="inline-flex items-center justify-center px-2 py-0.5 rounded-full text-xs font-bold bg-brand-500/20 text-brand-300 border border-brand-500/30 shadow-sm">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Actions & Profile -->
                <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">
                    
                    <div class="h-8 w-px bg-white/10 mx-1 sm:mx-2 hidden sm:block"></div>

                    <!-- Profile Dropdown (Alpine) -->
                    <div class="relative" x-data="{ profileOpen: false }" @click.away="profileOpen = false">
                        <button @click="profileOpen = !profileOpen" class="flex items-center gap-3 p-1 pr-2 sm:pr-3 rounded-2xl hover:bg-white/5 border border-transparent hover:border-white/10 focus:outline-none transition-all group">
                            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center text-white font-bold shadow-lg shadow-brand-500/20 group-hover:scale-105 transition-transform">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="text-right hidden lg:block">
                                <p class="text-sm font-bold text-gray-200 group-hover:text-white transition-colors">{{ explode(' ', Auth::user()->name)[0] }}</p>
                            </div>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors hidden sm:block"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="profileOpen" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                             class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50 overflow-hidden"
                             style="display: none;">
                            <div class="px-4 py-3 border-b border-gray-50 bg-gray-50/50 mb-2">
                                <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs font-medium text-gray-500 truncate">{{ Auth::user()->email ?? 'Akun '.ucfirst(Auth::user()->role) }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-brand-50 hover:text-brand-600 transition-colors group">
                                <i data-lucide="user" class="w-4 h-4 mr-3 text-gray-400 group-hover:text-brand-500 transition-colors"></i> Profil Saya
                            </a>
                            <div class="h-px bg-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-4 py-2.5 text-sm font-bold text-rose-600 hover:bg-rose-50 transition-colors group">
                                    <i data-lucide="log-out" class="w-4 h-4 mr-3 text-rose-400 group-hover:text-rose-600 transition-colors"></i> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Page Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 relative">
                <!-- Background Pattern -->
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.02] pointer-events-none"></div>

                <div class="max-w-7xl mx-auto relative z-10">
                    <!-- Flash Messages -->
                    @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl shadow-sm flex items-start justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3 flex-shrink-0">
                                <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                            </div>
                            <p class="font-medium text-sm">{{ session('success') }}</p>
                        </div>
                        <button @click="show = false" class="text-green-500 hover:text-green-700 focus:outline-none">
                            <i data-lucide="x" class="w-4 h-4 mt-1"></i>
                        </button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl shadow-sm flex items-start justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center mr-3 flex-shrink-0">
                                <i data-lucide="alert-circle" class="w-5 h-5 text-red-600"></i>
                            </div>
                            <p class="font-medium text-sm">{{ session('error') }}</p>
                        </div>
                        <button @click="show = false" class="text-red-500 hover:text-red-700 focus:outline-none">
                            <i data-lucide="x" class="w-4 h-4 mt-1"></i>
                        </button>
                    </div>
                    @endif

                    <!-- Page Slot -->
                    <div class="animate-fade-in-up">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.4s ease-out forwards;
        }
    </style>
</body>
</html>
