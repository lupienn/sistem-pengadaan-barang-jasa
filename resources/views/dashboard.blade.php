<x-app-layout>
    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-sm text-gray-500 mt-1">Ringkasan dan statistik pengadaan barang dan jasa.</p>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        {{-- Total Pengajuan --}}
        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex items-start space-x-4">
            <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0">
                <i data-lucide="layers" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Total</p>
                <p class="text-2xl font-bold text-gray-900 leading-tight">{{ $stats['total'] }}</p>
                <p class="text-xs text-gray-400">Pengajuan</p>
            </div>
        </div>

        {{-- Pending --}}
        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex items-start space-x-4">
            <div class="w-11 h-11 rounded-xl bg-amber-100 flex items-center justify-center text-amber-600 flex-shrink-0">
                <i data-lucide="clock" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Menunggu</p>
                <p class="text-2xl font-bold text-gray-900 leading-tight">{{ $stats['pending'] }}</p>
                <p class="text-xs text-gray-400">Perlu ditindak</p>
            </div>
        </div>

        {{-- Approved --}}
        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex items-start space-x-4">
            <div class="w-11 h-11 rounded-xl bg-green-100 flex items-center justify-center text-green-600 flex-shrink-0">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Disetujui</p>
                <p class="text-2xl font-bold text-gray-900 leading-tight">{{ $stats['approved'] }}</p>
                <p class="text-xs text-gray-400">Pengajuan</p>
            </div>
        </div>

        {{-- Rejected --}}
        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex items-start space-x-4">
            <div class="w-11 h-11 rounded-xl bg-red-100 flex items-center justify-center text-red-600 flex-shrink-0">
                <i data-lucide="x-circle" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Ditolak</p>
                <p class="text-2xl font-bold text-gray-900 leading-tight">{{ $stats['rejected'] }}</p>
                <p class="text-xs text-gray-400">Pengajuan</p>
            </div>
        </div>
    </div>

    {{-- Total Nilai Pengadaan --}}
    <div class="bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl shadow-sm p-5 mb-6 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                <i data-lucide="banknote" class="w-6 h-6 text-white"></i>
            </div>
            <div>
                <p class="text-sm font-semibold text-blue-100">Total Estimasi Nilai Pengadaan</p>
                <p class="text-2xl font-bold text-white">Rp {{ number_format($stats['total_nilai'], 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="hidden sm:flex items-center text-blue-200 text-sm">
            <i data-lucide="trending-up" class="w-5 h-5 mr-1"></i>
            Semua status
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Pengajuan Terbaru --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-base font-bold text-gray-800">Pengajuan Terbaru</h2>
                <a href="{{ route('requests.index') }}" class="text-sm text-blue-600 hover:underline font-medium flex items-center">
                    Lihat semua <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            @if(Auth::user()->role === 'manager')
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Pemohon</th>
                            @endif
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Barang</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Nilai</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentRequests as $req)
                        <tr class="hover:bg-gray-50 transition">
                            @if(Auth::user()->role === 'manager')
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-2">
                                    <div class="w-7 h-7 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-xs flex-shrink-0">
                                        {{ substr($req->user->name ?? '-', 0, 1) }}
                                    </div>
                                    <span class="text-gray-700 font-medium truncate max-w-[100px]">{{ $req->user->name ?? '-' }}</span>
                                </div>
                            </td>
                            @endif
                            <td class="px-4 py-3">
                                <p class="text-gray-800 font-medium truncate max-w-[160px]">{{ $req->nama_barang }}</p>
                                <p class="text-xs text-gray-400">Qty: {{ $req->jumlah }}</p>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <span class="font-semibold text-blue-600 text-xs">Rp {{ number_format($req->estimasi_harga * $req->jumlah, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($req->status === 'Pending')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1"></span> Menunggu
                                    </span>
                                @elseif($req->status === 'Approved')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1"></span> Disetujui
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1"></span> Ditolak
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-400 text-sm italic">
                                Belum ada pengajuan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Aksi Cepat --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100">
                <h2 class="text-base font-bold text-gray-800">Aksi Cepat</h2>
            </div>
            <div class="p-4 space-y-3">
                <a href="{{ route('requests.index') }}" class="flex items-center p-3 bg-gray-50 hover:bg-blue-50 rounded-lg transition group">
                    <div class="w-9 h-9 rounded-lg bg-blue-500 group-hover:bg-blue-600 flex items-center justify-center text-white mr-3 flex-shrink-0 transition">
                        <i data-lucide="clipboard-list" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">Lihat Semua Pengajuan</p>
                        <p class="text-xs text-gray-400">Kelola daftar pengajuan</p>
                    </div>
                </a>

                @if(Auth::user()->role === 'staff')
                <a href="{{ route('requests.create') }}" class="flex items-center p-3 bg-gray-50 hover:bg-green-50 rounded-lg transition group">
                    <div class="w-9 h-9 rounded-lg bg-green-500 group-hover:bg-green-600 flex items-center justify-center text-white mr-3 flex-shrink-0 transition">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">Buat Pengajuan Baru</p>
                        <p class="text-xs text-gray-400">Isi formulir pengajuan</p>
                    </div>
                </a>
                @endif

                <a href="{{ route('profile.edit') }}" class="flex items-center p-3 bg-gray-50 hover:bg-purple-50 rounded-lg transition group">
                    <div class="w-9 h-9 rounded-lg bg-purple-500 group-hover:bg-purple-600 flex items-center justify-center text-white mr-3 flex-shrink-0 transition">
                        <i data-lucide="user-circle" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">Edit Profil</p>
                        <p class="text-xs text-gray-400">Perbarui data akun Anda</p>
                    </div>
                </a>

                {{-- Progress bar status --}}
                @if($stats['total'] > 0)
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <p class="text-xs font-semibold text-gray-500 uppercase mb-3">Rasio Status</p>
                    <div class="space-y-2">
                        <div>
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span>Disetujui</span>
                                <span>{{ $stats['total'] > 0 ? round(($stats['approved'] / $stats['total']) * 100) : 0 }}%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-1.5">
                                <div class="bg-green-500 h-1.5 rounded-full" style="width: {{ $stats['total'] > 0 ? round(($stats['approved'] / $stats['total']) * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span>Menunggu</span>
                                <span>{{ $stats['total'] > 0 ? round(($stats['pending'] / $stats['total']) * 100) : 0 }}%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-1.5">
                                <div class="bg-amber-400 h-1.5 rounded-full" style="width: {{ $stats['total'] > 0 ? round(($stats['pending'] / $stats['total']) * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span>Ditolak</span>
                                <span>{{ $stats['total'] > 0 ? round(($stats['rejected'] / $stats['total']) * 100) : 0 }}%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-1.5">
                                <div class="bg-red-400 h-1.5 rounded-full" style="width: {{ $stats['total'] > 0 ? round(($stats['rejected'] / $stats['total']) * 100) : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
