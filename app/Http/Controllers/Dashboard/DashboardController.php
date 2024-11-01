<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::guard('admin')->user();

        // Menghitung total laporan
        $totalLaporan = DB::table('reports')->count();

        // Menghitung jumlah laporan menjadi bangunan
        $laporanMenjadiBangunan = DB::table('reports')
            ->where('perubahan', 'Pertanian Menjadi Bangunan')
            ->count();

        // Menghitung jumlah laporan menjadi timbunan
        $laporanMenjadiTimbunan = DB::table('reports')
            ->where('perubahan', 'Pertanian Menjadi Timbunan')
            ->count();

        // Menghitung jumlah laporan lainnya
        $laporanLainnya = DB::table('reports')
            ->whereNotIn('perubahan', ['Pertanian Menjadi Bangunan', 'Pertanian Menjadi Timbunan'])
            ->count();

        // Mengambil laporan dan mengelompokkan berdasarkan bulan dan jenis perubahan
        $laporanBulanan = DB::table('reports')
            ->select(DB::raw('MONTH(created_at) as bulan, perubahan, COUNT(*) as jumlah'))
            ->groupBy('bulan', 'perubahan')
            ->orderBy('bulan')
            ->get();

        // Data bulan
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Mengelompokkan data untuk ditampilkan dalam tabel dan chart
        $chartData = [
            'bulan' => [],
            'menjadi_bangunan' => [],
            'menjadi_timbunan' => [],
            'lainnya' => []
        ];

        foreach ($laporanBulanan as $laporan) {
            $bulan = $laporan->bulan;

            // Menyimpan bulan ke dalam array dengan nama bulan
            if (!in_array($months[$bulan], $chartData['bulan'])) {
                $chartData['bulan'][] = $months[$bulan];
            }

            // Mengelompokkan data untuk bar chart
            switch ($laporan->perubahan) {
                case 'Pertanian Menjadi Bangunan':
                    $chartData['menjadi_bangunan'][$bulan] = $laporan->jumlah;
                    break;
                case 'Pertanian Menjadi Timbunan':
                    $chartData['menjadi_timbunan'][$bulan] = $laporan->jumlah;
                    break;
                default:
                    $chartData['lainnya'][$bulan] = $laporan->jumlah;
                    break;
            }
        }

        // Pastikan data untuk bar chart lengkap
        $chartData['menjadi_bangunan'] = array_values($chartData['menjadi_bangunan']);
        $chartData['menjadi_timbunan'] = array_values($chartData['menjadi_timbunan']);
        $chartData['lainnya'] = array_values($chartData['lainnya']);


        // Kirim data ke view
        return view('dashboard.index', compact('user', 'totalLaporan', 'laporanMenjadiBangunan', 'laporanMenjadiTimbunan', 'laporanLainnya', 'chartData'));
    }
}
