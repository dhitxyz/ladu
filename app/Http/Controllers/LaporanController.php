<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLaporanRequest;
use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{
public function laporanSaya(Request $request)
{
    $query = Laporan::query();

    if ($request->status && $request->status != 'semua') {
        $query->where('status', $request->status);
    }

    $laporans = $query->latest()->get();

    return view('user.laporansaya', compact('laporans'));
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

        Laporan::create($validatedData);

        return back()->with('success', 'Laporan berhasil dikirim!');
    }
}
