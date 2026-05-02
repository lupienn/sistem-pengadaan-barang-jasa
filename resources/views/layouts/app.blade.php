<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Procurement System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest" onload="lucide.createIcons()"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6">
                <h1 class="text-xl font-bold tracking-wider uppercase text-blue-400">Pengadaan Barang</h1>
                <p class="text-xs text-gray-400 mt-1">Sistem Monitoring Digital</p>
            </div>
            <nav class="flex-1 px-4 space-y-2 mt-4">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-gray-800 text-blue-400' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition duration-200">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('requests.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('requests.*') ? 'bg-gray-800 text-blue-400' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition duration-200">
                    <i data-lucide="shopping-cart" class="w-5 h-5 mr-3"></i>
                    <span>Pengajuan</span>
                </a>
                @if(Auth::user()->role === 'staff')
                <a href="{{ route('requests.create') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('requests.create') ? 'bg-gray-800 text-blue-400' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition duration-200">
                    <i data-lucide="plus-circle" class="w-5 h-5 mr-3"></i>
                    <span>Buat Pengajuan</span>
                </a>
                @endif
            </nav>
            <div class="p-4 border-t border-gray-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-3 text-gray-400 hover:text-red-400 transition duration-200">
                        <i data-lucide="log-out" class="w-5 h-5 mr-3"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-8 z-10">
                <div class="md:hidden">
                    <h1 class="text-lg font-bold text-gray-800">Pengadaan</h1>
                </div>
                <div class="hidden md:block">
                    <h2 class="text-sm font-medium text-gray-500">Selamat datang, <span class="text-gray-900 font-bold">{{ Auth::user()->name }}</span> ({{ ucfirst(Auth::user()->role) }})</h2>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative group">
                        <button class="flex items-center focus:outline-none">
                            <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-8 bg-gray-50">
                @if(session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex items-center">
                    <i data-lucide="check-circle" class="w-5 h-5 mr-3"></i>
                    <p>{{ session('success') }}</p>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm flex items-center">
                    <i data-lucide="alert-circle" class="w-5 h-5 mr-3"></i>
                    <p>{{ session('error') }}</p>
                </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
    <script>
        // Initialize Lucide icons after content is rendered
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
</body>
</html>
