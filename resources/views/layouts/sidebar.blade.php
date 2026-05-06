<aside class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-gradient-to-b from-secondary to-white" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto">
        <a href="{{ route('dashboard') }}" class="flex items-center ps-2.5 mb-5">
            <div class="w-8 h-8 me-2 rounded-lg bg-blue-600 flex items-center justify-center text-white flex-shrink-0">
                <i data-lucide="shopping-bag" class="w-5 h-5"></i>
            </div>
            <span class="self-center text-sm font-semibold whitespace-nowrap leading-tight">Pengadaan Barang<br><span class="text-xs font-normal text-gray-500">&amp; Jasa</span></span>
        </a>
        <ul class="space-y-2 font-medium">
            {{-- Common Menu --}}
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-background-alt group {{ request()->routeIs('dashboard') ? 'bg-background-alt' : '' }}">
                    <x-lucide-layout-dashboard class="w-5 h-5 text-black" />
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('requests.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-background-alt group {{ request()->routeIs('requests.*') ? 'bg-background-alt' : '' }}">
                    <x-lucide-clipboard-list class="w-5 h-5 text-black" />
                    <span class="ms-3">Daftar Pengajuan</span>
                </a>
            </li>

            {{-- Role-based Menus --}}
            @if(auth()->user()->role === 'staff')
                <li>
                    <a href="{{ route('requests.create') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-background-alt group {{ request()->routeIs('requests.create') ? 'bg-background-alt' : '' }}">
                        <x-lucide-plus-circle class="w-5 h-5 text-black" />
                        <span class="flex-1 ms-3 whitespace-nowrap">Buat Pengajuan</span>
                    </a>
                </li>
            @endif

            @if(auth()->user()->role === 'admin')
                <li>
                    <a href="{{ route('admin.verifikasi.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-background-alt group {{ request()->routeIs('admin.verifikasi.index') ? 'bg-background-alt' : '' }}">
                        <x-lucide-user-check class="w-5 h-5 text-black" />
                        <span class="flex-1 ms-3 whitespace-nowrap">Manajemen Verifikasi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-background-alt group {{ request()->routeIs('admin.users.index') ? 'bg-background-alt' : '' }}">
                        <x-lucide-users class="w-5 h-5 text-black" />
                        <span class="flex-1 ms-3 whitespace-nowrap">Data Pengguna</span>
                    </a>
                </li>
            @endif
        </ul>

        {{-- Logout Button at the bottom --}}
        <div class="absolute bottom-0 left-0 w-full p-4">
             <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <x-lucide-log-out class="w-5 h-5 text-black" />
                    <span class="flex-1 ms-3 whitespace-nowrap">Keluar</span>
                </a>
            </form>
        </div>
    </div>
</aside>
