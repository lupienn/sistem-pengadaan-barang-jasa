<x-app-layout>
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Daftar Pengajuan</h1>
            <p class="text-gray-500 mt-1">Semua riwayat pengajuan pengadaan barang dan jasa.</p>
        </div>
        @if(Auth::user()->role === 'staff')
        <a href="{{ route('requests.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-brand-600 border border-transparent rounded-xl font-bold text-sm text-white hover:bg-brand-700 focus:bg-brand-700 active:bg-brand-900 focus:outline-none focus:ring-4 focus:ring-brand-200 transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-0.5">
            <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
            Buat Pengajuan
        </a>
        @endif
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Search and Filter Bar (Mockup for future functionality) -->
        <div class="p-5 border-b border-gray-50 flex flex-col sm:flex-row gap-4 justify-between bg-gray-50/50">
            <div class="relative max-w-sm w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
                </div>
                <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm transition-shadow" placeholder="Cari barang atau pemohon...">
            </div>
            <div class="flex items-center gap-2">
                <button class="inline-flex items-center px-4 py-2 border border-gray-200 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-colors">
                    <i data-lucide="filter" class="w-4 h-4 mr-2 text-gray-400"></i>
                    Filter
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-white border-b border-gray-100">
                    <tr>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-bold text-gray-400 uppercase tracking-wider whitespace-nowrap hidden md:table-cell">ID</th>
                        @if(Auth::user()->role === 'manager')
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-bold text-gray-400 uppercase tracking-wider hidden md:table-cell">Pemohon</th>
                        @endif
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Barang</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center hidden md:table-cell">Qty</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right hidden md:table-cell">Estimasi Total</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center hidden md:table-cell">Status</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center hidden md:table-cell">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($requests as $request)
                    <tr class="hover:bg-gray-50/80 transition-colors group">
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm font-bold text-gray-900 whitespace-nowrap hidden md:table-cell">{{ str_pad($request->id, 2, '0', STR_PAD_LEFT) }}</td>
                        
                        @if(Auth::user()->role === 'manager')
                        <td class="px-4 md:px-6 py-3 md:py-4 hidden md:table-cell">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-brand-100 flex items-center justify-center text-brand-700 font-bold text-xs shadow-sm flex-shrink-0">
                                    {{ substr($request->user->name ?? '-', 0, 1) }}
                                </div>
                                <span class="text-sm font-semibold text-gray-900 truncate max-w-[150px]" title="{{ $request->user->name ?? '-' }}">{{ $request->user->name ?? '-' }}</span>
                            </div>
                        </td>
                        @endif
                        
                        <td class="px-4 md:px-6 py-4 md:py-4 min-w-0 md:min-w-0 w-full md:w-auto">
                            <!-- Tampilan Desktop -->
                            <span class="text-sm font-semibold text-gray-900 line-clamp-2 hidden md:block">{{ $request->nama_barang }}</span>
                            
                            <!-- Tampilan Mobile (Card Style) -->
                            <div class="md:hidden flex flex-col gap-3">
                                <div class="flex items-start justify-between gap-3">
                                    <span class="text-sm font-bold text-gray-900 line-clamp-2 leading-tight">{{ $request->nama_barang }}</span>
                                    <div class="flex-shrink-0">
                                        @if($request->status === 'Pending')
                                        <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200 uppercase tracking-wider">Wait</span>
                                        @elseif($request->status === 'Approved')
                                        <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase tracking-wider">ACC</span>
                                        @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200 uppercase tracking-wider">Tolak</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="flex flex-col gap-1.5 text-xs text-gray-500 bg-gray-50 p-3.5 rounded-xl border border-gray-100 shadow-sm">
                                    <div class="flex justify-between items-center gap-2">
                                        <span class="text-gray-400">ID:</span> <span class="font-bold text-gray-700">{{ str_pad($request->id, 2, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                    @if(Auth::user()->role === 'manager')
                                    <div class="flex justify-between items-center gap-2">
                                        <span class="text-gray-400">Pemohon:</span> <span class="font-semibold text-gray-700 truncate text-right max-w-[140px]" title="{{ $request->user->name ?? '-' }}">{{ $request->user->name ?? '-' }}</span>
                                    </div>
                                    @endif
                                    <div class="flex justify-between items-center gap-2">
                                        <span class="text-gray-400">Qty:</span> <span class="font-semibold text-gray-700">{{ $request->jumlah }}</span>
                                    </div>
                                    <div class="flex justify-between items-center gap-2">
                                        <span class="text-gray-400">Total:</span> <span class="font-bold text-brand-600">Rp {{ number_format($request->estimasi_harga * $request->jumlah, 0, ',', '.') }}</span>
                                    </div>
                                    
                                    <div class="mt-2.5 pt-2.5 border-t border-gray-100/80">
                                        <a href="{{ route('requests.show', $request->id) }}" class="flex items-center justify-center px-4 py-2.5 text-brand-600 bg-brand-50 hover:bg-brand-600 hover:text-white rounded-lg transition-colors font-bold w-full text-center shadow-sm">
                                            <i data-lucide="eye" class="w-4 h-4 mr-2"></i> Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm font-medium text-gray-600 text-center hidden md:table-cell">
                            {{ $request->jumlah }}
                        </td>
                        
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm text-right whitespace-nowrap hidden md:table-cell">
                            <span class="font-bold text-brand-600">Rp {{ number_format($request->estimasi_harga * $request->jumlah, 0, ',', '.') }}</span>
                        </td>
                        
                        <td class="px-4 md:px-6 py-3 md:py-4 text-center whitespace-nowrap hidden md:table-cell">
                            @if($request->status === 'Pending')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Menunggu
                            </span>
                            @elseif($request->status === 'Approved')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Disetujui
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Ditolak
                            </span>
                            @endif
                        </td>
                        
                        <td class="px-4 md:px-6 py-3 md:py-4 text-center hidden md:table-cell">
                            <a href="{{ route('requests.show', $request->id) }}" class="inline-flex items-center justify-center p-2 sm:p-2.5 text-brand-600 hover:text-white bg-brand-50 hover:bg-brand-600 rounded-lg transition-colors shadow-sm" title="Lihat Detail">
                                <i data-lucide="eye" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ Auth::user()->role === 'manager' ? 7 : 6 }}" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <i data-lucide="folder-open" class="w-16 h-16 mb-4 opacity-20"></i>
                                <p class="text-base font-semibold text-gray-500">Belum ada data pengajuan</p>
                                <p class="text-sm mt-1">Data pengajuan yang dibuat akan tampil di sini.</p>
                                @if(Auth::user()->role === 'staff')
                                <a href="{{ route('requests.create') }}" class="mt-4 text-sm font-medium text-brand-600 hover:text-brand-700 hover:underline">Buat pengajuan pertama</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination area (Mockup layout) -->
        @if(count($requests) > 0)
        <div class="px-6 py-4 border-t border-gray-50 bg-gray-50/50 flex items-center justify-between">
            <span class="text-sm text-gray-500 font-medium">Menampilkan <span class="font-bold text-gray-900">{{ count($requests) }}</span> data</span>
            <!-- Laravel pagination links would go here -->
        </div>
        @endif
    </div>
</x-app-layout>
