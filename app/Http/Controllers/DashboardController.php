<?php

namespace App\Http\Controllers;

use App\Models\ProcurementRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'manager') {
            $stats = [
                'total'    => ProcurementRequest::count(),
                'pending'  => ProcurementRequest::where('status', 'Pending')->count(),
                'approved' => ProcurementRequest::where('status', 'Approved')->count(),
                'rejected' => ProcurementRequest::where('status', 'Rejected')->count(),
                'total_nilai' => ProcurementRequest::selectRaw('SUM(estimasi_harga * jumlah) as total')->value('total') ?? 0,
            ];
            $recentRequests = ProcurementRequest::with('user')->latest()->take(5)->get();
        } else {
            $stats = [
                'total'    => ProcurementRequest::where('user_id', $user->id)->count(),
                'pending'  => ProcurementRequest::where('user_id', $user->id)->where('status', 'Pending')->count(),
                'approved' => ProcurementRequest::where('user_id', $user->id)->where('status', 'Approved')->count(),
                'rejected' => ProcurementRequest::where('user_id', $user->id)->where('status', 'Rejected')->count(),
                'total_nilai' => ProcurementRequest::where('user_id', $user->id)->selectRaw('SUM(estimasi_harga * jumlah) as total')->value('total') ?? 0,
            ];
            $recentRequests = ProcurementRequest::where('user_id', $user->id)->latest()->take(5)->get();
        }

        return view('dashboard', compact('stats', 'recentRequests'));
    }
}
