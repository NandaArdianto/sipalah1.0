<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin; // Pastikan model ini sudah ada dan diimpor

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Atau menggunakan auth()->user();
        // Return the view for the dashboard
        return view('auth.profile', compact('user'));
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'foto_profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file upload
        ]);

        $user = Auth::user(); // Mendapatkan user yang sedang login

        if ($request->hasFile('foto_profile')) {
            // Hapus foto lama jika ada
            if ($user->foto_profile && Storage::disk('public')->exists($user->foto_profile)) {
                Storage::disk('public')->delete($user->foto_profile);
            }

            // Upload foto baru ke public/avatars
            $path = $request->file('foto_profile')->store('avatars', 'public');

            // Simpan path foto baru ke dalam database
            $user->foto_profile = $path;
            $user->save();
        }

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }

    public function removeProfilePicture()
    {
        $user = Auth::user();

        if ($user->foto_profile && Storage::disk('public')->exists($user->foto_profile)) {
            Storage::disk('public')->delete($user->foto_profile);
        }

        $user->foto_profile = null;
        $user->save();

        return back()->with('success', 'Foto profil berhasil dihapus!');
    }

    public function getProfilePicture($filename)
    {
        $path = public_path('storage/avatars/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
