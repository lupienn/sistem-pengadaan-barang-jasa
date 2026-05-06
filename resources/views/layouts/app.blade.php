<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Pengadaan Barang & Jasa') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
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
            <header class="bg-white/80 backdrop-blur-md border-b border-gray-100 h-16 flex items-center justify-between px-4 sm:px-6 lg:px-8 z-30 sticky top-0">
                <!-- Left Side: Mobile Menu Button & Title -->
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="md:hidden text-gray-500 hover:text-brand-600 focus:outline-none transition-colors">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div class="md:hidden">
                        <h1 class="text-lg font-bold text-gray-900 tracking-tight">Pengadaan</h1>
                    </div>
                    <div class="hidden md:flex flex-col justify-center">
                        <h2 class="text-sm text-gray-500 font-medium">Selamat datang kembali,</h2>
                        <p class="text-sm font-bold text-gray-900 leading-tight">{{ Auth::user()->name }} <span class="text-xs font-normal text-brand-600 bg-brand-50 px-2 py-0.5 rounded-full ml-1">{{ ucfirst(Auth::user()->role) }}</span></p>
                    </div>
                </div>

                <!-- Right Side: User Profile -->
                <div class="flex items-center gap-4">
                    <!-- Notifications (Mockup) -->
                    <button class="relative p-2 text-gray-400 hover:text-brand-600 transition-colors rounded-full hover:bg-gray-100">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 border-2 border-white rounded-full"></span>
                    </button>

                    <div class="h-8 w-px bg-gray-200"></div>

                    <!-- Profile Dropdown (Alpine) -->
                    <div class="relative" x-data="{ profileOpen: false }" @click.away="profileOpen = false">
                        <button @click="profileOpen = !profileOpen" class="flex items-center gap-3 focus:outline-none group">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-semibold text-gray-700 group-hover:text-brand-600 transition-colors">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }}</p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-brand-500 to-brand-400 flex items-center justify-center text-white font-bold shadow-md ring-2 ring-white group-hover:ring-brand-100 transition-all">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400 group-hover:text-brand-500 transition-colors hidden sm:block"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="profileOpen" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                             class="absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50"
                             style="display: none;">
                            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-brand-50 hover:text-brand-600 transition-colors">
                                <i data-lucide="user" class="w-4 h-4 mr-3"></i> Profil Saya
                            </a>
                            <div class="h-px bg-gray-100 my-2"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <i data-lucide="log-out" class="w-4 h-4 mr-3"></i> Keluar
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
