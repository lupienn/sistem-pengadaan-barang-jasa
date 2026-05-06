<!-- Backdrop for mobile -->
<div x-show="sidebarOpen" 
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 bg-gray-900/80 z-40 md:hidden" 
     @click="sidebarOpen = false" 
     style="display: none;"></div>

<!-- Sidebar -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       class="fixed inset-y-0 left-0 z-50 w-72 bg-dark-900 text-white transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-auto md:flex md:flex-col shadow-2xl">
    
    <!-- Logo area -->
    <div class="flex items-center justify-center h-20 border-b border-white/10 px-6">
        <div class="flex items-center gap-3 w-full">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center shadow-lg shadow-brand-500/30">
                <i data-lucide="package" class="w-6 h-6 text-white"></i>
            </div>
            <div class="flex flex-col">
                <span class="text-lg font-bold tracking-wide text-white leading-tight">Pengadaan</span>
                <span class="text-xs text-brand-400 font-medium">Sistem Monitoring</span>
            </div>
        </div>
        <!-- Close button (Mobile only) -->
        <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-white focus:outline-none">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto custom-scrollbar">
        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Menu Utama</p>
        
        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-brand-600/10 text-brand-400 border border-brand-500/20 shadow-inner' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
            <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-brand-400' : 'group-hover:text-brand-400 transition-colors' }}"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="{{ route('requests.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('requests.index', 'requests.show') ? 'bg-brand-600/10 text-brand-400 border border-brand-500/20 shadow-inner' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
            <i data-lucide="clipboard-list" class="w-5 h-5 mr-3 {{ request()->routeIs('requests.index', 'requests.show') ? 'text-brand-400' : 'group-hover:text-brand-400 transition-colors' }}"></i>
            <span class="font-medium">Daftar Pengajuan</span>
        </a>

        @if(Auth::user()->role === 'staff')
        <a href="{{ route('requests.create') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('requests.create') ? 'bg-brand-600/10 text-brand-400 border border-brand-500/20 shadow-inner' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
            <i data-lucide="plus-circle" class="w-5 h-5 mr-3 {{ request()->routeIs('requests.create') ? 'text-brand-400' : 'group-hover:text-brand-400 transition-colors' }}"></i>
            <span class="font-medium">Buat Pengajuan</span>
        </a>
        @endif

        @if(Auth::user()->role === 'admin')
        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mt-6 mb-2">Administrator</p>
        
        <a href="{{ route('admin.verifikasi.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.verifikasi.*') ? 'bg-brand-600/10 text-brand-400 border border-brand-500/20 shadow-inner' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
            <i data-lucide="user-check" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.verifikasi.*') ? 'text-brand-400' : 'group-hover:text-brand-400 transition-colors' }}"></i>
            <span class="font-medium">Verifikasi Akun</span>
        </a>

        <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.users.*') ? 'bg-brand-600/10 text-brand-400 border border-brand-500/20 shadow-inner' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
            <i data-lucide="users" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.users.*') ? 'text-brand-400' : 'group-hover:text-brand-400 transition-colors' }}"></i>
            <span class="font-medium">Data Pengguna</span>
        </a>
        @endif
    </nav>

    <!-- Bottom User Area -->
    <div class="p-4 border-t border-white/10 bg-dark-950/50">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full px-4 py-3 text-sm font-medium text-gray-400 rounded-xl hover:bg-red-500/10 hover:text-red-400 transition-all duration-200 group border border-transparent hover:border-red-500/20">
                <i data-lucide="log-out" class="w-5 h-5 mr-3 group-hover:text-red-400 transition-colors"></i>
                <span>Keluar Aplikasi</span>
            </button>
        </form>
    </div>
</aside>
<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
    }
    .custom-scrollbar:hover::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.2);
    }
</style>
