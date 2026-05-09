<?php

namespace App\Http\Controllers;

use App\Models\ProcurementRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'manager') {
            $requests = ProcurementRequest::with('user')->orderBy('id')->get();
        } else {
            $requests = ProcurementRequest::where('user_id', $user->id)->orderBy('id')->get();
        }

        return view('requests.index', compact('requests'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'staff') {
            abort(403);
        }

        return view('requests.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'staff') {
            abort(403);
        }

        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'estimasi_harga' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        Auth::user()->procurementRequests()->create($validated);

        return redirect()->route('requests.index')->with('success', 'Pengajuan berhasil dibuat.');
    }

    public function show($id)
    {
        $procurementRequest = ProcurementRequest::with('user')->findOrFail($id);

        // Staff can only see their own requests
        if (Auth::user()->role === 'staff' && $procurementRequest->user_id !== Auth::id()) {
            abort(403);
        }

        return view('requests.show', compact('procurementRequest'));
    }

    public function approve($id)
    {
        if (Auth::user()->role !== 'manager') {
            abort(403);
        }

        $procurementRequest = ProcurementRequest::findOrFail($id);
        $procurementRequest->update(['status' => 'Approved']);

        return redirect()->route('requests.show', $id)->with('success', 'Pengajuan telah disetujui.');
    }

    public function reject($id)
    {
        if (Auth::user()->role !== 'manager') {
            abort(403);
        }

        $procurementRequest = ProcurementRequest::findOrFail($id);
        $procurementRequest->update(['status' => 'Rejected']);

        return redirect()->route('requests.show', $id)->with('success', 'Pengajuan telah ditolak.');
    }
}
