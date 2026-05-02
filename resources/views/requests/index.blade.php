<x-app-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Pengajuan</h1>
            <p class="text-gray-600">Semua riwayat pengajuan pengadaan barang dan jasa.</p>
        </div>
        @if(Auth::user()->role === 'staff')
        <a href="{{ route('requests.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Tambah Pengajuan
        </a>
        @endif
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-600 text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        @if(Auth::user()->role === 'manager')
                        <th class="px-6 py-4">Pemohon</th>
                        @endif
                        <th class="px-6 py-4">Nama Barang</th>
                        <th class="px-6 py-4 text-center">Jumlah</th>
                        <th class="px-6 py-4 text-right">Estimasi Total</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($requests as $request)
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">#{{ $request->id }}</td>
                        @if(Auth::user()->role === 'manager')
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $request->user->name }}</td>
                        @endif
                        <td class="px-6 py-4 text-sm text-gray-600 font-medium">{{ $request->nama_barang }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">{{ $request->jumlah }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-right font-semibold text-blue-600">
                            Rp {{ number_format($request->estimasi_harga * $request->jumlah, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($request->status === 'Pending')
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-700 border border-yellow-200 uppercase">Pending</span>
                            @elseif($request->status === 'Approved')
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700 border border-green-200 uppercase">Approved</span>
                            @else
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-700 border border-red-200 uppercase">Rejected</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('requests.show', $request->id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm">
                                <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ Auth::user()->role === 'manager' ? 7 : 6 }}" class="px-6 py-10 text-center text-gray-500 italic">
                            Belum ada data pengajuan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
