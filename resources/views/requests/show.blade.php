<x-app-layout>
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center">
            <a href="{{ route('requests.index') }}" class="mr-4 p-2 bg-white rounded-full shadow-sm hover:shadow-md transition duration-200">
                <i data-lucide="arrow-left" class="w-5 h-5 text-gray-600"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Pengajuan #{{ $procurementRequest->id }}</h1>
                <p class="text-gray-600">Informasi lengkap pengajuan barang/jasa.</p>
            </div>
        </div>
        <div>
            @if($procurementRequest->status === 'Pending')
                <span class="px-4 py-2 text-sm font-bold rounded-full bg-yellow-100 text-yellow-700 border border-yellow-200 uppercase tracking-wider shadow-sm">Status: Pending</span>
            @elseif($procurementRequest->status === 'Approved')
                <span class="px-4 py-2 text-sm font-bold rounded-full bg-green-100 text-green-700 border border-green-200 uppercase tracking-wider shadow-sm">Status: Approved</span>
            @else
                <span class="px-4 py-2 text-sm font-bold rounded-full bg-red-100 text-red-700 border border-red-200 uppercase tracking-wider shadow-sm">Status: Rejected</span>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Details -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center">
                    <i data-lucide="info" class="w-5 h-5 text-blue-500 mr-2"></i>
                    <h2 class="text-lg font-bold text-gray-800">Informasi Barang / Jasa</h2>
                </div>
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Nama Barang / Jasa</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $procurementRequest->nama_barang }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Jumlah (Qty)</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $procurementRequest->jumlah }} Unit</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Estimasi Harga Satuan</p>
                        <p class="text-lg font-semibold text-gray-800">Rp {{ number_format($procurementRequest->estimasi_harga, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Estimasi Biaya</p>
                        <p class="text-xl font-bold text-blue-600">Rp {{ number_format($procurementRequest->estimasi_harga * $procurementRequest->jumlah, 0, ',', '.') }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Keterangan / Alasan</p>
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-100 text-gray-700 italic">
                            {{ $procurementRequest->keterangan ?: 'Tidak ada keterangan tambahan.' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Info & Actions -->
        <div class="space-y-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center">
                    <i data-lucide="user" class="w-5 h-5 text-blue-500 mr-2"></i>
                    <h2 class="text-lg font-bold text-gray-800">Informasi Pemohon</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Nama Staff</p>
                        <p class="font-semibold text-gray-800">{{ $procurementRequest->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Waktu Pengajuan</p>
                        <p class="font-semibold text-gray-800">{{ $procurementRequest->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            @if(Auth::user()->role === 'manager' && $procurementRequest->status === 'Pending')
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden p-6 space-y-4">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Tindakan Manager</h3>
                <div class="flex flex-col space-y-3">
                    <form action="{{ route('requests.approve', $procurementRequest->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 bg-green-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-200 transition duration-200">
                            <i data-lucide="check" class="w-4 h-4 mr-2"></i>
                            Approve Pengajuan
                        </button>
                    </form>
                    <form action="{{ route('requests.reject', $procurementRequest->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 bg-red-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-200 transition duration-200">
                            <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                            Reject Pengajuan
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
