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
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight flex items-center gap-3">
                        Detail Pengajuan
                        <span class="px-3 py-1 rounded-lg bg-gray-100 text-lg text-gray-500 font-bold border border-gray-200">{{ str_pad($procurementRequest->id, 2, '0', STR_PAD_LEFT) }}</span>
                    </h1>
                    <p class="text-gray-500 mt-1">Tinjauan lengkap informasi pengadaan barang dan jasa.</p>
                </div>
            </div>
            <div class="flex-shrink-0">
                @if($procurementRequest->status === 'Pending')
                    <div class="inline-flex items-center gap-2.5 px-5 py-2.5 rounded-2xl bg-amber-50 text-amber-700 border border-amber-200/60 shadow-sm">
                        <span class="relative flex h-3.5 w-3.5">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-amber-500"></span>
                        </span>
                        <span class="font-bold uppercase tracking-wider text-sm">Menunggu Review</span>
                    </div>
                @elseif($procurementRequest->status === 'Approved')
                    <div class="inline-flex items-center gap-2.5 px-5 py-2.5 rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-200/60 shadow-sm">
                        <div class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                            <i data-lucide="check" class="w-3.5 h-3.5 stroke-[3]"></i>
                        </div>
                        <span class="font-bold uppercase tracking-wider text-sm">Disetujui</span>
                    </div>
                @else
                    <div class="inline-flex items-center gap-2.5 px-5 py-2.5 rounded-2xl bg-rose-50 text-rose-700 border border-rose-200/60 shadow-sm">
                        <div class="w-6 h-6 rounded-full bg-rose-100 flex items-center justify-center text-rose-600">
                            <i data-lucide="x" class="w-3.5 h-3.5 stroke-[3]"></i>
                        </div>
                        <span class="font-bold uppercase tracking-wider text-sm">Ditolak</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Details -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-400 to-brand-600"></div>
                <div class="p-6 sm:p-8 border-b border-gray-50 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-brand-50 flex items-center justify-center text-brand-600 border border-brand-100">
                        <i data-lucide="package-search" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Informasi Barang & Harga</h2>
                        <p class="text-sm text-gray-500">Rincian spesifikasi dan estimasi biaya</p>
                    </div>
                </div>
                <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="md:col-span-2 group">
                        <div class="flex items-center gap-2 mb-2">
                            <i data-lucide="tag" class="w-4 h-4 text-brand-500"></i>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Nama Barang / Jasa</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50/50 border border-gray-100 group-hover:border-brand-200 group-hover:bg-brand-50/30 transition-colors">
                            <p class="text-xl font-bold text-gray-900">{{ $procurementRequest->nama_barang }}</p>
                        </div>
                    </div>
                    
                    <div class="group">
                        <div class="flex items-center gap-2 mb-2">
                            <i data-lucide="boxes" class="w-4 h-4 text-brand-500"></i>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Jumlah (Qty)</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50/50 border border-gray-100 group-hover:border-brand-200 group-hover:bg-brand-50/30 transition-colors">
                            <p class="text-lg font-bold text-gray-900 flex items-baseline gap-1">{{ $procurementRequest->jumlah }} <span class="text-sm font-medium text-gray-500">Unit</span></p>
                        </div>
                    </div>
                    
                    <div class="group">
                        <div class="flex items-center gap-2 mb-2">
                            <i data-lucide="coins" class="w-4 h-4 text-brand-500"></i>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Estimasi Harga Satuan</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50/50 border border-gray-100 group-hover:border-brand-200 group-hover:bg-brand-50/30 transition-colors">
                            <p class="text-lg font-bold text-gray-900">Rp {{ number_format($procurementRequest->estimasi_harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    
                    <div class="md:col-span-2">
                        <div class="relative p-6 sm:p-8 rounded-2xl bg-gradient-to-br from-brand-600 to-brand-800 text-white overflow-hidden shadow-lg shadow-brand-500/30">
                            <!-- Background Decoration -->
                            <div class="absolute top-0 right-0 -mt-8 -mr-8 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
                            <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-24 h-24 bg-brand-400 opacity-20 rounded-full blur-xl"></div>
                            
                            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                                <div>
                                    <div class="flex items-center gap-2 mb-1.5 opacity-80">
                                        <i data-lucide="calculator" class="w-4 h-4"></i>
                                        <p class="text-xs font-bold uppercase tracking-widest">Total Estimasi Biaya</p>
                                    </div>
                                </div>
                                <div class="bg-white/10 backdrop-blur-md px-6 py-4 rounded-xl border border-white/20 shadow-inner">
                                    <p class="text-3xl sm:text-4xl font-black tracking-tight">Rp {{ number_format($procurementRequest->estimasi_harga * $procurementRequest->jumlah, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="md:col-span-2">
                        <div class="flex items-center gap-2 mb-3">
                            <i data-lucide="align-left" class="w-4 h-4 text-brand-500"></i>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Keterangan / Alasan</p>
                        </div>
                        <div class="p-6 bg-gray-50/50 rounded-2xl border border-gray-100 text-gray-700 leading-relaxed shadow-inner">
                            @if($procurementRequest->keterangan)
                                <p class="whitespace-pre-line">{{ $procurementRequest->keterangan }}</p>
                            @else
                                <div class="flex flex-col items-center justify-center py-6 text-gray-400">
                                    <i data-lucide="file-question" class="w-10 h-10 mb-2 opacity-20"></i>
                                    <span class="italic font-medium">Tidak ada keterangan tambahan yang disertakan.</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Info & Actions -->
        <div class="space-y-8">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center gap-3 bg-gray-50/30">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600 border border-purple-100">
                        <i data-lucide="user-circle" class="w-5 h-5"></i>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">Informasi Pemohon</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-purple-600 to-indigo-500 flex items-center justify-center text-white font-black text-xl shadow-md shadow-purple-500/20">
                            {{ substr($procurementRequest->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-lg font-extrabold text-gray-900">{{ $procurementRequest->user->name }}</p>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-gray-100 text-xs font-semibold text-gray-600 mt-1">
                                <i data-lucide="shield" class="w-3 h-3"></i>
                                {{ ucfirst($procurementRequest->user->role) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="space-y-4 pt-6 border-t border-gray-100">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Email</p>
                            <p class="text-sm font-medium text-gray-800 flex items-center gap-2"><i data-lucide="mail" class="w-4 h-4 text-gray-400"></i> {{ $procurementRequest->user->email ?? 'Tidak ada email' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Waktu Pengajuan</p>
                            <div class="flex items-start gap-2">
                                <i data-lucide="calendar-clock" class="w-4 h-4 text-gray-400 mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">{{ $procurementRequest->created_at->format('d F Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $procurementRequest->created_at->format('H:i') }} WIB &bull; {{ $procurementRequest->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(Auth::user()->role === 'manager' && $procurementRequest->status === 'Pending')
            <div class="bg-white rounded-3xl shadow-sm border border-brand-200 overflow-hidden relative group">
                <div class="absolute inset-0 bg-gradient-to-b from-brand-50/50 to-white pointer-events-none"></div>
                <div class="p-6 relative z-10">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-brand-100 flex items-center justify-center text-brand-600">
                            <i data-lucide="shield-check" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Tindakan Manager</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Review dan beri keputusan</p>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex flex-col gap-3">
                        <form id="approve-form" action="{{ route('requests.approve', $procurementRequest->id) }}" method="POST">
                            @csrf
                            <button type="button" onclick="confirmApprove()" class="w-full relative inline-flex justify-center items-center px-6 py-4 bg-emerald-600 border border-transparent rounded-2xl font-bold text-sm text-white uppercase tracking-widest hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-200/50 transition-all duration-300 shadow-lg shadow-emerald-500/30 hover:shadow-xl hover:shadow-emerald-500/40 hover:-translate-y-1 overflow-hidden group/btn">
                                <span class="absolute inset-0 w-full h-full bg-white/20 scale-x-0 group-hover/btn:scale-x-100 transform origin-left transition-transform duration-300"></span>
                                <i data-lucide="check-circle" class="w-5 h-5 mr-2 relative z-10"></i>
                                <span class="relative z-10">Setujui Pengajuan</span>
                            </button>
                        </form>
                        
                        <form id="reject-form" action="{{ route('requests.reject', $procurementRequest->id) }}" method="POST">
                            @csrf
                            <button type="button" onclick="confirmReject()" class="w-full inline-flex justify-center items-center px-6 py-4 bg-white border-2 border-rose-100 text-rose-600 rounded-2xl font-bold text-sm uppercase tracking-widest hover:bg-rose-50 hover:border-rose-200 hover:text-rose-700 focus:outline-none focus:ring-4 focus:ring-rose-100 transition-all duration-300">
                                <i data-lucide="x-circle" class="w-5 h-5 mr-2"></i>
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
                text: "Pastikan semua data sudah benar sebelum menyetujui.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#059669', // Emerald 600
                cancelButtonColor: '#9ca3af', // Gray 400
                confirmButtonText: 'Ya, Setujui',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-3xl p-8 shadow-2xl',
                    title: 'text-2xl font-black text-gray-900',
                    htmlContainer: 'text-base text-gray-500 mt-3',
                    actions: 'w-full flex flex-col-reverse sm:flex-row gap-3 mt-8 m-0 px-0',
                    confirmButton: 'w-full sm:w-auto px-8 py-4 bg-emerald-600 text-white rounded-2xl font-bold text-sm uppercase tracking-widest m-0 hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-500/30',
                    cancelButton: 'w-full sm:w-auto px-8 py-4 bg-gray-100 text-gray-700 rounded-2xl font-bold text-sm uppercase tracking-widest hover:bg-gray-200 transition-colors m-0'
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
                text: "Tindakan ini tidak dapat dibatalkan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48', // Rose 600
                cancelButtonColor: '#9ca3af', // Gray 400
                confirmButtonText: 'Ya, Tolak',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-3xl p-8 shadow-2xl',
                    title: 'text-2xl font-black text-gray-900',
                    htmlContainer: 'text-base text-gray-500 mt-3',
                    actions: 'w-full flex flex-col-reverse sm:flex-row gap-3 mt-8 m-0 px-0',
                    confirmButton: 'w-full sm:w-auto px-8 py-4 bg-rose-600 text-white rounded-2xl font-bold text-sm uppercase tracking-widest m-0 hover:bg-rose-700 transition-colors shadow-lg shadow-rose-500/30',
                    cancelButton: 'w-full sm:w-auto px-8 py-4 bg-gray-100 text-gray-700 rounded-2xl font-bold text-sm uppercase tracking-widest hover:bg-gray-200 transition-colors m-0'
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
