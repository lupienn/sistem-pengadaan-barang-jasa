<x-app-layout>
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('requests.index') }}" class="p-2.5 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:bg-gray-50 transition-all duration-200 group">
                <i data-lucide="arrow-left" class="w-5 h-5 text-gray-500 group-hover:text-brand-600 transition-colors"></i>
            </a>
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight flex items-center gap-3">
                    Detail Pengajuan
                    <span class="text-xl text-gray-400 font-medium">{{ str_pad($procurementRequest->id, 2, '0', STR_PAD_LEFT) }}</span>
                </h1>
            </div>
        </div>
        <div>
            @if($procurementRequest->status === 'Pending')
                <span class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold rounded-xl bg-amber-50 text-amber-700 border border-amber-200 uppercase tracking-wider shadow-sm">
                    <span class="relative flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span>
                    </span>
                    Status: Menunggu
                </span>
            @elseif($procurementRequest->status === 'Approved')
                <span class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase tracking-wider shadow-sm">
                    <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                    Status: Disetujui
                </span>
            @else
                <span class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold rounded-xl bg-rose-50 text-rose-700 border border-rose-200 uppercase tracking-wider shadow-sm">
                    <i data-lucide="x-circle" class="w-4 h-4"></i>
                    Status: Ditolak
                </span>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Details -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 bg-gray-50/50 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-brand-100 flex items-center justify-center text-brand-600 shadow-inner">
                        <i data-lucide="box" class="w-5 h-5"></i>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800">Informasi Barang & Harga</h2>
                </div>
                <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
                    <div class="md:col-span-2">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5 flex items-center gap-1.5"><i data-lucide="tag" class="w-3.5 h-3.5"></i> Nama Barang / Jasa</p>
                        <p class="text-xl font-bold text-gray-900">{{ $procurementRequest->nama_barang }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5 flex items-center gap-1.5"><i data-lucide="boxes" class="w-3.5 h-3.5"></i> Jumlah (Qty)</p>
                        <p class="text-lg font-semibold text-gray-900 flex items-baseline gap-1">{{ $procurementRequest->jumlah }} <span class="text-sm font-medium text-gray-500">Unit/Pcs</span></p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5 flex items-center gap-1.5"><i data-lucide="coins" class="w-3.5 h-3.5"></i> Estimasi Harga Satuan</p>
                        <p class="text-lg font-semibold text-gray-900">Rp {{ number_format($procurementRequest->estimasi_harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="md:col-span-2 p-6 bg-brand-50 rounded-xl border border-brand-100/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <p class="text-xs font-bold text-brand-600/80 uppercase tracking-widest mb-1">Total Estimasi Biaya</p>
                            <p class="text-sm text-brand-600/60">Berdasarkan perkiraan harga saat pengajuan</p>
                        </div>
                        <p class="text-3xl font-extrabold text-brand-600 tracking-tight">Rp {{ number_format($procurementRequest->estimasi_harga * $procurementRequest->jumlah, 0, ',', '.') }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 flex items-center gap-1.5"><i data-lucide="align-left" class="w-3.5 h-3.5"></i> Keterangan / Alasan</p>
                        <div class="p-5 bg-gray-50 rounded-xl border border-gray-100 text-gray-700 leading-relaxed shadow-sm">
                            @if($procurementRequest->keterangan)
                                {{ $procurementRequest->keterangan }}
                            @else
                                <span class="italic text-gray-400">Tidak ada keterangan tambahan yang disertakan oleh pemohon.</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Info & Actions -->
        <div class="space-y-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 bg-gray-50/50 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600 shadow-inner">
                        <i data-lucide="user" class="w-5 h-5"></i>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800">Pemohon</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-purple-500 to-purple-400 flex items-center justify-center text-white font-bold text-lg shadow-md">
                            {{ substr($procurementRequest->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">{{ $procurementRequest->user->name }}</p>
                            <p class="text-sm text-gray-500 flex items-center gap-1 mt-0.5"><i data-lucide="mail" class="w-3 h-3"></i> {{ $procurementRequest->user->email }}</p>
                        </div>
                    </div>
                    <div class="pt-6 border-t border-gray-100">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5 flex items-center gap-1.5"><i data-lucide="calendar" class="w-3.5 h-3.5"></i> Waktu Pengajuan</p>
                        <p class="font-semibold text-gray-800">{{ $procurementRequest->created_at->format('d M Y, H:i') }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $procurementRequest->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            @if(Auth::user()->role === 'manager' && $procurementRequest->status === 'Pending')
            <div class="bg-white rounded-2xl shadow-sm border border-brand-200 overflow-hidden relative group">
                <div class="absolute inset-0 bg-gradient-to-b from-brand-50 to-white pointer-events-none"></div>
                <div class="p-6 relative z-10">
                    <div class="flex items-center gap-2 mb-4">
                        <i data-lucide="shield-check" class="w-5 h-5 text-brand-600"></i>
                        <h3 class="text-lg font-bold text-gray-900">Tindakan Manager</h3>
                    </div>
                    <p class="text-sm text-gray-500 mb-6">Silakan tinjau detail pengajuan di atas sebelum memberikan persetujuan atau penolakan.</p>
                    
                    <div class="flex flex-col gap-3">
                        <form id="approve-form" action="{{ route('requests.approve', $procurementRequest->id) }}" method="POST">
                            @csrf
                            <button type="button" onclick="confirmApprove()" class="w-full inline-flex justify-center items-center px-6 py-3.5 bg-emerald-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-200 transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                                <i data-lucide="check-circle" class="w-4 h-4 mr-2"></i>
                                Setujui Pengajuan
                            </button>
                        </form>
                        
                        <form id="reject-form" action="{{ route('requests.reject', $procurementRequest->id) }}" method="POST">
                            @csrf
                            <button type="button" onclick="confirmReject()" class="w-full inline-flex justify-center items-center px-6 py-3.5 bg-white border-2 border-rose-100 text-rose-600 rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-rose-50 hover:border-rose-200 focus:outline-none focus:ring-4 focus:ring-rose-100 transition-all duration-200">
                                <i data-lucide="x-circle" class="w-4 h-4 mr-2"></i>
                                Tolak Pengajuan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <script>
        function confirmApprove() {
            Swal.fire({
                title: 'Setujui Pengajuan?',
                text: "Apakah Anda yakin ingin menyetujui pengajuan ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#059669', // Emerald 600
                cancelButtonColor: '#9ca3af', // Gray 400
                confirmButtonText: 'Ya, Setujui',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'px-4 py-2 bg-emerald-600 text-white rounded-xl font-bold text-sm uppercase tracking-wider ml-2',
                    cancelButton: 'px-4 py-2 bg-gray-200 text-gray-700 rounded-xl font-bold text-sm uppercase tracking-wider'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('approve-form').submit();
                }
            })
        }

        function confirmReject() {
            Swal.fire({
                title: 'Tolak Pengajuan?',
                text: "Apakah Anda yakin ingin menolak pengajuan ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48', // Rose 600
                cancelButtonColor: '#9ca3af', // Gray 400
                confirmButtonText: 'Ya, Tolak',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'px-4 py-2 bg-rose-600 text-white rounded-xl font-bold text-sm uppercase tracking-wider ml-2',
                    cancelButton: 'px-4 py-2 bg-gray-200 text-gray-700 rounded-xl font-bold text-sm uppercase tracking-wider'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('reject-form').submit();
                }
            })
        }
    </script>
</x-app-layout>
