<x-app-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-600">Ringkasan pengajuan pengadaan barang dan jasa.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-4">
                <i data-lucide="layers" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total Pengajuan</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
            </div>
        </div>

        <!-- Pending Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
            <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 mr-4">
                <i data-lucide="clock" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Pending</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['pending'] }}</p>
            </div>
        </div>

        <!-- Approved Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 mr-4">
                <i data-lucide="check-square" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Approved</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['approved'] }}</p>
            </div>
        </div>

        <!-- Rejected Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-600 mr-4">
                <i data-lucide="x-circle" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Rejected</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['rejected'] }}</p>
            </div>
        </div>
    </div>

    <div class="mt-10 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">Aksi Cepat</h2>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('requests.index') }}" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white mr-4">
                    <i data-lucide="list" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="font-bold text-gray-800">Lihat Semua Pengajuan</p>
                    <p class="text-sm text-gray-500">Melihat daftar lengkap pengajuan barang/jasa.</p>
                </div>
            </a>
            @if(Auth::user()->role === 'staff')
            <a href="{{ route('requests.create') }}" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center text-white mr-4">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="font-bold text-gray-800">Buat Pengajuan Baru</p>
                    <p class="text-sm text-gray-500">Formulir pengajuan barang atau jasa baru.</p>
                </div>
            </a>
            @endif
        </div>
    </div>
</x-app-layout>
