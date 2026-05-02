<x-app-layout>
    <div class="mb-8 flex items-center">
        <a href="{{ route('requests.index') }}" class="mr-4 p-2 bg-white rounded-full shadow-sm hover:shadow-md transition duration-200">
            <i data-lucide="arrow-left" class="w-5 h-5 text-gray-600"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Buat Pengajuan Baru</h1>
            <p class="text-gray-600">Isi formulir di bawah ini untuk mengajukan barang atau jasa.</p>
        </div>
    </div>

    <div class="max-w-2xl bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('requests.store') }}" method="POST" class="p-8 space-y-6">
            @csrf
            
            <div>
                <label for="nama_barang" class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Barang / Jasa</label>
                <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}" required
                       class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm"
                       placeholder="Contoh: Laptop Office, Jasa Maintenance AC, dll.">
                @error('nama_barang')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="jumlah" class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Jumlah (Qty)</label>
                    <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', 1) }}" min="1" required
                           class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm">
                    @error('jumlah')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="estimasi_harga" class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Estimasi Harga Satuan (Rp)</label>
                    <input type="number" name="estimasi_harga" id="estimasi_harga" value="{{ old('estimasi_harga') }}" min="0" required
                           class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm"
                           placeholder="0">
                    @error('estimasi_harga')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="keterangan" class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Keterangan / Alasan Pengadaan</label>
                <textarea name="keterangan" id="keterangan" rows="4"
                          class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm"
                          placeholder="Jelaskan secara singkat kegunaan atau alasan pengadaan ini...">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 border-t border-gray-50 flex items-center justify-end space-x-4">
                <a href="{{ route('requests.index') }}" class="px-6 py-2 text-sm font-bold text-gray-500 hover:text-gray-700">Batal</a>
                <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg shadow-md hover:bg-blue-700 transition duration-200 focus:ring-4 focus:ring-blue-200">
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
