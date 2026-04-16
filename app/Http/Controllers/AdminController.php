<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $totalLaporan = Laporan::count();
        $pendingLaporan = Laporan::where('status', 'pending')->count();
        $diprosesDaporan = Laporan::where('status', 'diproses')->count();
        $selesaiLaporan = Laporan::where('status', 'selesai')->count();

        $query = Laporan::with('user');

        if ($request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function ($userQuery) use ($request) {
                      $userQuery->where('nama_lengkap', 'like', '%' . $request->search . '%');
                  });
        }

        $laporanTerbaru = $query->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalLaporan',
            'pendingLaporan',
            'diprosesDaporan',
            'selesaiLaporan',
            'laporanTerbaru'
        ));
    }

    public function laporan(Request $request)
    {
        $query = Laporan::with('user');

        $status = $request->get('status');
        if ($status && $status !== 'semua') {
            $query->where('status', $status);
        }

        if ($request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function ($userQuery) use ($request) {
                      $userQuery->where('nama_lengkap', 'like', '%' . $request->search . '%');
                  });
        }

        $laporans = $query->latest()->paginate(10);

        $stats = [
            'semua' => Laporan::count(),
            'pending' => Laporan::where('status', 'pending')->count(),
            'diproses' => Laporan::where('status', 'diproses')->count(),
            'selesai' => Laporan::where('status', 'selesai')->count(),
        ];

        return view('admin.laporan', compact('laporans', 'status', 'stats', 'request'));
    }

    public function showLaporan($id)
    {
        $laporan = Laporan::with('user')->findOrFail($id);

        return view('admin.detail-laporan', compact('laporan'));
    }

    public function updateStatusLaporan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update(['status' => $request->status]);

        return back()->with('success', 'Status laporan berhasil diubah!');
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->role && $request->role !== 'semua') {
            $query->where('role', $request->role);
        }

        if ($request->search) {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('username', 'like', '%' . $request->search . '%');
        }

        $users = $query->paginate(10);

        return view('admin.users', compact('users'));
    }

    public function showUser($id)
    {
        $user = User::findOrFail($id);
        $laporanCount = Laporan::where('user_id', $id)->count();

        return view('admin.detail-user', compact('user', 'laporanCount'));
    }
}
