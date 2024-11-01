<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all();
        return view('reports.index', compact('reports'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'perubahan' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'foto.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'keterangan' => 'nullable|string',
            'nama_pelapor' => 'required|string',
            'email' => 'required|email',
            'nohp' => 'required|string',
            'alamat' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Jika pilihan "Lainnya" dipilih, ambil dari input lainnya_text
        if ($request->perubahan === 'Lainnya') {
            $validated['perubahan'] = $request->lainnya_text;
        }

        if ($request->hasFile('foto')) {
            $paths = [];
            foreach ($request->file('foto') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('foto', $fileName, 'public');
                $paths[] = 'foto/' . $fileName; // Simpan path relatif
            }
            $validated['foto'] = json_encode($paths); // Encode array path sebagai JSON
        }
        

        Report::create($validated);

        return redirect()->back()->with('success', ' Laporan Anda telah berhasil ditambahkan. Terima kasih atas kontribusi Anda dalam pengelolaan lahan.');
    }

    public function showReportsMap()
    {
        $reports = Report::all(); // Mengambil semua laporan
        return response()->json($reports); // Mengembalikan data dalam format JSON
    }
    
}
