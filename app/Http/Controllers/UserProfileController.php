<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * Menampilkan halaman profil
     */
    public function show()
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login
        return view('profile.show', compact('user'));
    }

    /**
     * Menampilkan halaman edit profil
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Memperbarui data profil pengguna
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->bio = $request->input('bio'); // Pastikan kolom bio diupdate

        // Menyimpan gambar profil jika ada
        if ($request->hasFile('profile_image')) {
            // Menghapus gambar lama jika ada
            if ($user->profile_image) {
                Storage::delete('public/' . $user->profile_image);
            }

            // Menyimpan gambar baru
            $user->profile_image = $request->file('profile_image')->store('profile_images', 'public');
        }

        $user->save();

        return redirect()->route('profile.show')->with('status', 'Profile updated successfully!');
    }
}
