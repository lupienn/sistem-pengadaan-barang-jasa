<x-app-layout>
    {{-- Header --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Dashboard Utama</h1>
            <p class="text-sm text-gray-500 mt-1">Ringkasan aktivitas dan status pengadaan barang & jasa.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Periode:</span>
            <span class="px-3 py-1.5 bg-white border border-gray-200 rounded-lg text-sm font-medium text-gray-700 shadow-sm">Semua Waktu</span>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Total Pengajuan --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-start gap-4 hover:-translate-y-1 hover:shadow-md transition-all duration-300 group">
            <div class="w-14 h-14 rounded-2xl bg-brand-50 flex items-center justify-center text-brand-600 flex-shrink-0 group-hover:bg-brand-600 group-hover:text-white transition-colors duration-300">
                <i data-lucide="layers" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Pengajuan</p>
                <p class="text-3xl font-extrabold text-gray-900 leading-none">{{ $stats['total'] }}</p>
            </div>
        </div>

        {{-- Menunggu --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-start gap-4 hover:-translate-y-1 hover:shadow-md transition-all duration-300 group">
            <div class="w-14 h-14 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 flex-shrink-0 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300">
                <i data-lucide="clock" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Menunggu</p>
                <p class="text-3xl font-extrabold text-gray-900 leading-none">{{ $stats['pending'] }}</p>
            </div>
        </div>

        {{-- Disetujui --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-start gap-4 hover:-translate-y-1 hover:shadow-md transition-all duration-300 group">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 flex-shrink-0 group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300">
                <i data-lucide="check-circle" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Disetujui</p>
                <p class="text-3xl font-extrabold text-gray-900 leading-none">{{ $stats['approved'] }}</p>
            </div>
        </div>

        {{-- Ditolak --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-start gap-4 hover:-translate-y-1 hover:shadow-md transition-all duration-300 group">
            <div class="w-14 h-14 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-600 flex-shrink-0 group-hover:bg-rose-500 group-hover:text-white transition-colors duration-300">
                <i data-lucide="x-circle" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Ditolak</p>
                <p class="text-3xl font-extrabold text-gray-900 leading-none">{{ $stats['rejected'] }}</p>
            </div>
        </div>
    </div>

    {{-- Total Nilai Pengadaan --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-brand-600 to-brand-800 rounded-2xl shadow-lg p-8 mb-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
        <!-- Decorative background circles -->
        <div class="absolute top-0 right-0 -mt-8 -mr-8 w-48 h-48 bg-white opacity-5 rounded-full blur-2xl"></div>
        <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-32 h-32 bg-white opacity-10 rounded-full blur-xl"></div>
        
        <div class="relative z-10 flex items-center gap-5">
            <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-inner border border-white/10">
                <i data-lucide="wallet" class="w-8 h-8 text-white"></i>
            </div>
            <div>
                <p class="text-brand-100 font-medium tracking-wide mb-1">Total Estimasi Nilai Pengadaan</p>
                <p class="text-4xl font-extrabold text-white tracking-tight">Rp {{ number_format($stats['total_nilai'], 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="relative z-10 hidden lg:flex items-center gap-2 bg-black/20 backdrop-blur-md px-4 py-2 rounded-xl border border-white/10">
            <i data-lucide="trending-up" class="w-5 h-5 text-brand-200"></i>
            <span class="text-sm font-medium text-white">Berdasarkan semua data</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Pengajuan Terbaru --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-gray-50 flex items-center justify-between bg-gray-50/50">
                <h2 class="text-lg font-bold text-gray-900">Pengajuan Terbaru</h2>
                <a href="{{ route('requests.index') }}" class="text-sm text-brand-600 hover:text-brand-700 font-semibold flex items-center group transition-colors">
                    Lihat Semua <i data-lucide="arrow-right" class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-sm text-left">
                    <thead class="bg-white border-b border-gray-100">
                        <tr>
                            @if(Auth::user()->role === 'manager')
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Pemohon</th>
                            @endif
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Barang</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Nilai</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentRequests as $req)
                        <tr class="hover:bg-gray-50/80 transition-colors group">
                            @if(Auth::user()->role === 'manager')
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-brand-100 flex items-center justify-center text-brand-700 font-bold text-xs shadow-sm">
                                        {{ substr($req->user->name ?? '-', 0, 1) }}
                                    </div>
                                    <span class="text-gray-900 font-semibold truncate max-w-[120px]">{{ $req->user->name ?? '-' }}</span>
                                </div>
                            </td>
                            @endif
                            <td class="px-6 py-4">
                                <p class="text-gray-900 font-semibold truncate max-w-[200px]">{{ $req->nama_barang }}</p>
                                <p class="text-xs text-gray-500 mt-0.5"><span class="font-medium">Qty:</span> {{ $req->jumlah }}</p>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="font-bold text-gray-900">Rp {{ number_format($req->estimasi_harga * $req->jumlah, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($req->status === 'Pending')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Menunggu
                                    </span>
                                @elseif($req->status === 'Approved')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Disetujui
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Ditolak
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <i data-lucide="inbox" class="w-12 h-12 mb-3 opacity-20"></i>
                                    <p class="text-sm font-medium">Belum ada pengajuan terbaru.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Aksi Cepat & Ringkasan --}}
        <div class="flex flex-col gap-6">
            {{-- Aksi Cepat --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-50 bg-gray-50/50">
                    <h2 class="text-lg font-bold text-gray-900">Pintasan</h2>
                </div>
                <div class="p-5 space-y-3">
                    <a href="{{ route('requests.index') }}" class="flex items-center p-3 rounded-xl hover:bg-gray-50 border border-transparent hover:border-gray-100 transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mr-4 group-hover:scale-110 group-hover:bg-blue-500 group-hover:text-white transition-all shadow-sm">
                            <i data-lucide="list" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors">Daftar Pengajuan</p>
                            <p class="text-xs text-gray-500">Lihat semua riwayat</p>
                        </div>
                    </a>

                    @if(Auth::user()->role === 'staff')
                    <a href="{{ route('requests.create') }}" class="flex items-center p-3 rounded-xl hover:bg-gray-50 border border-transparent hover:border-gray-100 transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mr-4 group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white transition-all shadow-sm">
                            <i data-lucide="plus" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">Buat Pengajuan</p>
                            <p class="text-xs text-gray-500">Ajukan barang baru</p>
                        </div>
                    </a>
                    @endif

                    <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded-xl hover:bg-gray-50 border border-transparent hover:border-gray-100 transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mr-4 group-hover:scale-110 group-hover:bg-purple-500 group-hover:text-white transition-all shadow-sm">
                            <i data-lucide="user" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900 group-hover:text-purple-600 transition-colors">Pengaturan Profil</p>
                            <p class="text-xs text-gray-500">Perbarui data Anda</p>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Progress bar status --}}
            @if($stats['total'] > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-5">Rasio Status Pengajuan</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-xs font-bold text-gray-600 mb-1.5">
                            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Disetujui</span>
                            <span>{{ round(($stats['approved'] / $stats['total']) * 100) }}%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-emerald-500 h-2 rounded-full transition-all duration-1000 ease-out" style="width: {{ round(($stats['approved'] / $stats['total']) * 100) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-xs font-bold text-gray-600 mb-1.5">
                            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-amber-400"></span> Menunggu</span>
                            <span>{{ round(($stats['pending'] / $stats['total']) * 100) }}%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-amber-400 h-2 rounded-full transition-all duration-1000 ease-out" style="width: {{ round(($stats['pending'] / $stats['total']) * 100) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-xs font-bold text-gray-600 mb-1.5">
                            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-rose-500"></span> Ditolak</span>
                            <span>{{ round(($stats['rejected'] / $stats['total']) * 100) }}%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-rose-500 h-2 rounded-full transition-all duration-1000 ease-out" style="width: {{ round(($stats['rejected'] / $stats['total']) * 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
