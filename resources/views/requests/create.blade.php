<x-app-layout>
    <!-- Header Section -->
    <div class="mb-8 relative rounded-3xl bg-white border border-gray-100 shadow-sm overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-brand-50/50 to-white pointer-events-none"></div>
        <div class="relative p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <a href="{{ route('requests.index') }}" class="p-3 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-brand-200 hover:bg-brand-50 transition-all duration-300 group flex-shrink-0">
                    <i data-lucide="arrow-left" class="w-5 h-5 text-gray-500 group-hover:text-brand-600 transition-colors"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Buat Pengajuan Baru</h1>
                </div>
            </div>
            <div class="hidden sm:block">
                <div class="w-16 h-16 rounded-2xl bg-brand-50 flex items-center justify-center text-brand-600 border border-brand-100 shadow-inner">
                    <i data-lucide="file-plus-2" class="w-8 h-8"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative" x-data="{ jumlah: {{ old('jumlah', 1) }}, estimasi: {{ old('estimasi_harga', 0) ?: 'null' }} }">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-brand-400 to-brand-600"></div>
        
        <div class="p-6 sm:p-8 border-b border-gray-50 flex items-center gap-4 bg-gray-50/30">
            <div class="w-12 h-12 rounded-2xl bg-brand-50 flex items-center justify-center text-brand-600 border border-brand-100">
                <i data-lucide="clipboard-list" class="w-6 h-6"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">Formulir Pengadaan</h2>
                <p class="text-sm text-gray-500">Silakan isi data dengan teliti untuk mempercepat proses verifikasi.</p>
            </div>
        </div>

        <form action="{{ route('requests.store') }}" method="POST" class="p-6 sm:p-10 space-y-8">
            @csrf
            
            <!-- Nama Barang -->
            <div class="space-y-2 group">
                <label for="nama_barang" class="block text-sm font-bold text-gray-700 transition-colors group-focus-within:text-brand-600">Nama Barang / Jasa <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i data-lucide="package" class="w-5 h-5 text-gray-400 transition-colors group-focus-within:text-brand-500"></i>
                    </div>
                    <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}" required
                           class="block w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-200 focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 transition-all shadow-sm bg-gray-50/50 focus:bg-white text-gray-900 font-medium">
                </div>
                @error('nama_barang')
                    <p class="mt-2 text-sm font-medium text-red-600 flex items-center"><i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Grid: Qty & Harga -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2 group">
                    <label for="jumlah" class="block text-sm font-bold text-gray-700 transition-colors group-focus-within:text-brand-600">Jumlah (Qty) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="layers" class="w-5 h-5 text-gray-400 transition-colors group-focus-within:text-brand-500"></i>
                        </div>
                        <input type="number" name="jumlah" id="jumlah" x-model="jumlah" min="1" required
                               class="block w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-200 focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 transition-all shadow-sm bg-gray-50/50 focus:bg-white text-gray-900 font-bold">
                    </div>
                    @error('jumlah')
                        <p class="mt-2 text-sm font-medium text-red-600 flex items-center"><i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2 group">
                    <label for="estimasi_harga" class="block text-sm font-bold text-gray-700 transition-colors group-focus-within:text-brand-600">Estimasi Harga Satuan <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 font-black">
                            Rp
                        </div>
                        <input type="number" name="estimasi_harga" id="estimasi_harga" x-model="estimasi" min="0" required
                               class="block w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-200 focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 transition-all shadow-sm bg-gray-50/50 focus:bg-white text-gray-900 font-bold">
                    </div>
                    @error('estimasi_harga')
                        <p class="mt-2 text-sm font-medium text-red-600 flex items-center"><i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Kalkulasi Total Harga: Receipt Style -->
            <div x-show="jumlah && estimasi" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-brand-600 to-brand-400 rounded-3xl blur opacity-20 group-hover:opacity-30 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative p-6 sm:p-8 rounded-3xl bg-brand-50 border border-brand-100 flex flex-col sm:flex-row sm:items-center justify-between gap-6 overflow-hidden">
                    <!-- Background Decoration -->
                    <div class="absolute -right-4 -bottom-4 opacity-5 pointer-events-none">
                        <i data-lucide="calculator" class="w-32 h-32"></i>
                    </div>
                    
                    <div class="flex items-center gap-4 relative z-10">
                        <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center text-brand-600 shadow-sm border border-brand-100">
                            <i data-lucide="wallet" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <span class="text-xs font-black text-brand-600/70 uppercase tracking-[0.2em]">Total Estimasi Biaya</span>
                            <p class="text-sm text-brand-600/60 font-medium">Berdasarkan (Qty × Harga Satuan)</p>
                        </div>
                    </div>
                    
                    <div class="relative z-10 bg-white px-6 py-4 rounded-2xl border border-brand-100 shadow-sm">
                        <span class="text-3xl font-black text-brand-700 tracking-tight">
                            Rp <span x-text="new Intl.NumberFormat('id-ID').format(jumlah * estimasi)"></span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Keterangan -->
            <div class="space-y-2 group">
                <label for="keterangan" class="block text-sm font-bold text-gray-700 transition-colors group-focus-within:text-brand-600">Keterangan / Alasan Pengadaan</label>
                <div class="relative">
                    <div class="absolute top-4 left-4 pointer-events-none">
                        <i data-lucide="text-quote" class="w-5 h-5 text-gray-400 transition-colors group-focus-within:text-brand-500"></i>
                    </div>
                    <textarea name="keterangan" id="keterangan" rows="5"
                              class="block w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-200 focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 transition-all shadow-sm bg-gray-50/50 focus:bg-white text-gray-900 font-medium"></textarea>
                </div>
                @error('keterangan')
                    <p class="mt-2 text-sm font-medium text-red-600 flex items-center"><i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="pt-8 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-end gap-4">
                <a href="{{ route('requests.index') }}" class="w-full sm:w-auto px-8 py-4 text-sm font-bold text-gray-500 bg-white border-2 border-gray-100 hover:bg-gray-50 hover:border-gray-200 hover:text-gray-700 rounded-2xl transition-all duration-300 text-center focus:outline-none focus:ring-4 focus:ring-gray-100">
                    Batalkan & Kembali
                </a>
                <button type="submit" class="group/btn w-full sm:w-auto px-10 py-4 bg-brand-600 text-white font-black text-sm rounded-2xl shadow-xl shadow-brand-500/20 hover:bg-brand-700 hover:shadow-brand-500/30 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-brand-200 hover:-translate-y-1 flex items-center justify-center relative overflow-hidden">
                    <span class="absolute inset-0 w-full h-full bg-white/20 scale-x-0 group-hover/btn:scale-x-100 transform origin-left transition-transform duration-300"></span>
                    <i data-lucide="send" class="w-5 h-5 mr-2 relative z-10 transition-transform group-hover/btn:translate-x-1 group-hover/btn:-translate-y-1"></i>
                    <span class="relative z-10 tracking-widest uppercase">Kirim Pengajuan</span>
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
