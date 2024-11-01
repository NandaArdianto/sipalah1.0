<?php

namespace App\Http\Controllers\Peta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Geodata;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class MapController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Atau menggunakan auth()->user();
        // Return the view for the dashboard
        return view('dashboard.peta', compact('user'));
    }

    public function pemetaan()
    {
        $user = Auth::user(); // Atau menggunakan auth()->user();
        // Return the view for the dashboard
        return view('dashboard.pemetaan', compact('user'));
    }

    public function getGeoJson()
    {
        $geodata = Geodata::all();
        $features = [];

        foreach ($geodata as $data) {
            $features[] = [
                'type' => 'Feature',
                'properties' => json_decode($data->geojson)->properties,
                'geometry' => json_decode($data->geojson)->geometry,
            ];
        }

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features,
        ]);
    }

    // Method untuk create GeoJSON
    public function createGeoJson(Request $request)
    {
        // Decode GeoJSON dari request
        $geojsonData = json_decode($request->geojson, true);
    
        // Simpan data GeoJSON ke database
        $geodata = new Geodata();
        $geodata->nama = $request->nama;
        $geodata->geojson = json_encode($geojsonData); // Simpan GeoJSON sementara tanpa id
        $geodata->save();
    
        // Setelah geodata disimpan, update properti id di GeoJSON
        $geojsonData['properties']['id'] = $geodata->id;
    
        // Simpan GeoJSON dengan id yang baru ke database
        $geodata->geojson = json_encode($geojsonData);
        $geodata->save();
    
        return response()->json([
            'message' => 'Data berhasil disimpan!',
            'id' => $geodata->id // Kembalikan id yang baru dibuat
        ]);
    }
    

    // Method untuk update GeoJSON
    public function updateGeoJson(Request $request)
    {
        $geojsonData = json_decode($request->geojson, true);
        Log::info('Data yang diterima untuk update:', $geojsonData); // Cetak data yang diterima
    
        $geodata = Geodata::find($geojsonData['properties']['id']);
    
        if ($geodata) {
            $geodata->geojson = json_encode($geojsonData);
            $geodata->save();
    
            return response()->json(['message' => 'Data berhasil diperbarui!']);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan!'], 404);
        }
    }
    

    // Method untuk delete GeoJSON
    public function deleteGeoJson(Request $request)
    {
        // Cari data berdasarkan id dari request
        $geodata = Geodata::find($request->id);

        if ($geodata) {
            $geodata->delete();
            return response()->json(['message' => 'Data berhasil dihapus!']);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan!'], 404);
        }
    }
}
