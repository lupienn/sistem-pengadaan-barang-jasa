<x-app-layout>
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('requests.index') }}" class="p-2.5 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:bg-gray-50 transition-all duration-200 group">
            <i data-lucide="arrow-left" class="w-5 h-5 text-gray-500 group-hover:text-brand-600 transition-colors"></i>
        </a>
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Buat Pengajuan Baru</h1>
            <p class="text-gray-500 mt-1">Lengkapi formulir di bawah ini dengan detail barang/jasa yang dibutuhkan.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ jumlah: {{ old('jumlah', 1) }}, estimasi: {{ old('estimasi_harga', 0) ?: 'null' }} }">
        <div class="p-6 sm:p-8 border-b border-gray-50 bg-gray-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-brand-100 flex items-center justify-center text-brand-600 shadow-inner">
                    <i data-lucide="file-edit" class="w-5 h-5"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Formulir Pengadaan</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Kolom dengan tanda <span class="text-red-500">*</span> wajib diisi.</p>
                </div>
            </div>
        </div>

        <form action="{{ route('requests.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf
            
            <div class="space-y-1.5">
                <label for="nama_barang" class="block text-sm font-bold text-gray-700">Nama Barang / Jasa <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <i data-lucide="box" class="w-5 h-5 text-gray-400"></i>
                    </div>
                    <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}" required
                           class="block w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-brand-500/20 focus:border-brand-500 transition-all shadow-sm bg-gray-50/50 focus:bg-white text-gray-900"
                           placeholder="">
                </div>
                <p class="text-xs text-gray-500 ml-1">Sebutkan nama barang atau jasa dengan jelas dan spesifik.</p>
                @error('nama_barang')
                    <p class="mt-2 text-sm font-medium text-red-600 flex items-center"><i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i> {{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1.5">
                    <label for="jumlah" class="block text-sm font-bold text-gray-700">Jumlah (Qty) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i data-lucide="hash" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input type="number" name="jumlah" id="jumlah" x-model="jumlah" min="1" required
                               class="block w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-brand-500/20 focus:border-brand-500 transition-all shadow-sm bg-gray-50/50 focus:bg-white text-gray-900">
                    </div>
                    <p class="text-xs text-gray-500 ml-1">Masukkan jumlah yang dibutuhkan.</p>
                    @error('jumlah')
                        <p class="mt-2 text-sm font-medium text-red-600 flex items-center"><i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label for="estimasi_harga" class="block text-sm font-bold text-gray-700">Estimasi Harga Satuan <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-500 font-bold">
                            Rp
                        </div>
                        <input type="number" name="estimasi_harga" id="estimasi_harga" x-model="estimasi" min="0" required
                               class="block w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-brand-500/20 focus:border-brand-500 transition-all shadow-sm bg-gray-50/50 focus:bg-white text-gray-900 font-semibold"
                               placeholder="0">
                    </div>
                    <p class="text-xs text-gray-500 ml-1">Perkiraan harga untuk 1 unit barang/jasa.</p>
                    @error('estimasi_harga')
                        <p class="mt-2 text-sm font-medium text-red-600 flex items-center"><i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Kalkulasi Total Harga dengan AlpineJS -->
            <div class="p-4 bg-brand-50 rounded-xl border border-brand-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2" x-show="jumlah && estimasi" x-transition>
                <div class="flex items-center gap-2 text-brand-700">
                    <i data-lucide="calculator" class="w-5 h-5"></i>
                    <span class="text-sm font-semibold">Total Estimasi Biaya</span>
                </div>
                <div class="text-xl font-extrabold text-brand-700">
                    Rp <span x-text="new Intl.NumberFormat('id-ID').format(jumlah * estimasi)"></span>
                </div>
            </div>

            <div class="space-y-1.5">
                <label for="keterangan" class="block text-sm font-bold text-gray-700">Keterangan / Alasan Pengadaan</label>
                <div class="relative">
                    <div class="absolute top-3.5 left-3.5 pointer-events-none">
                        <i data-lucide="align-left" class="w-5 h-5 text-gray-400"></i>
                    </div>
                    <textarea name="keterangan" id="keterangan" rows="4"
                              class="block w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-brand-500/20 focus:border-brand-500 transition-all shadow-sm bg-gray-50/50 focus:bg-white text-gray-900"
                              placeholder="">{{ old('keterangan') }}</textarea>
                </div>
                <p class="text-xs text-gray-500 ml-1">Berikan alasan kuat mengapa barang/jasa ini diperlukan untuk memudahkan proses persetujuan.</p>
                @error('keterangan')
                    <p class="mt-2 text-sm font-medium text-red-600 flex items-center"><i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i> {{ $message }}</p>
                @enderror
            </div>

            <div class="pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-end gap-3">
                <a href="{{ route('requests.index') }}" class="w-full sm:w-auto px-6 py-3 text-sm font-bold text-gray-600 bg-white border border-gray-200 hover:bg-gray-50 hover:text-gray-900 rounded-xl transition-colors text-center focus:outline-none focus:ring-4 focus:ring-gray-100">
                    Batalkan
                </a>
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-brand-600 text-white font-bold text-sm rounded-xl shadow-md hover:bg-brand-700 hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-brand-200 hover:-translate-y-0.5 flex items-center justify-center">
                    <i data-lucide="send" class="w-4 h-4 mr-2"></i>
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
