<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;

use Illuminate\Support\Facades\Mail;
use App\Mail\StatusReportMail;

class LaporanController extends Controller
{
    public function index()
    {
        // Mengambil semua data laporan & Paginate the results
        $reports = Report::orderBy('created_at', 'desc')->paginate(10); // Menampilkan 10 laporan per halaman

        // Mengambil pengguna yang sedang login
        $user = Auth::user(); // Atau menggunakan auth()->user();

        // Return the view untuk dashboard
        return view('dashboard.laporan', compact('reports', 'user'));
    }

    public function validasi()
    {
        $user = Auth::user(); // Atau menggunakan auth()->user();
        $reports = Report::orderBy('created_at', 'desc')->paginate(5); // Menampilkan 5 laporan per halaman
        return view('dashboard.validasi', compact('reports', 'user')); // Pastikan view ini ada
    }

    public function generatePDF()
    {
        // Mengatur batas backtrack pcre
        ini_set("pcre.backtrack_limit", "5000000");
        $reports = Report::all();

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetBasePath(public_path('storage')); // Set base path agar gambar bisa diambil dari public storage

        $html = view('dashboard.pdf', compact('reports'))->render();
        $mpdf->WriteHTML($html);

        return $mpdf->Output('laporan.pdf', 'I'); // 'I' untuk menampilkan di browser, 'D' untuk mendownload
    }

    public function validateReport(Request $request, $id)
    {
        // Temukan laporan berdasarkan ID
        $report = Report::findOrFail($id);

        // Tentukan status berdasarkan request
        $status = $request->input('status', 'pending');

        if ($status === 'approved') {
            $report->status = 'approved';
        } elseif ($status === 'rejected') {
            $report->status = 'rejected';
        }

        // Simpan perubahan status
        $report->save();

        // Kirim email ke pelapor
        Mail::to($report->email)->send(new StatusReportMail($report, $status));

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Laporan berhasil divalidasi dan email terkirim!');
    }
}
