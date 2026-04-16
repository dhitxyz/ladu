<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLaporanRequest;
use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::where('user_id', auth()->id());

        if ($request->status && $request->status != 'semua') {
            $query->where('status', $request->status);
        }

        $laporans = $query->latest()->get();

        return view('user.laporan', compact('laporans'));
    }

    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);

        return view('user.detillaporan', compact('laporan'));
    }

    public function create()
    {
        $classifications = [
            'pengaduan' => 'Pengaduan',
            'aspirasi' => 'Aspirasi',
            'informasi' => 'Permintaan Informasi',
        ];

        $kategoris = config('kategori');

        return view('user.home', compact('classifications', 'kategoris'));
    }

    public function store(StoreLaporanRequest $request)
    {
        $validatedData = $request->validated();

        $lampiranPaths = [];

        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();

                $lampiranPaths[] = $file->storeAs(
                    'lampiran',
                    $filename,
                    'public'
                );
            }
        }

        $validatedData['lampiran'] = $lampiranPaths;
        $validatedData['user_id'] = auth()->id();

        Laporan::create($validatedData);

        return back()->with('success', 'Laporan berhasil dikirim!');
    }
}
