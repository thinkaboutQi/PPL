<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:15', // Validasi nomor telepon
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi gambar
        ]);

        // Update data pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number; // Update nomor telepon jika ada

        // Proses jika ada gambar baru
        if ($request->hasFile('profile_image')) {
            // Hapus gambar lama jika ada
            if ($user->profile_image && Storage::exists('public/' . $user->profile_image)) {
                Storage::delete('public/' . $user->profile_image);
            }

            // Simpan gambar baru
            $path = $request->file('profile_image')->store('photos', 'public');
            $user->profile_image = $path; // Simpan nama file gambar ke database
        }

        // Simpan perubahan data pengguna
        $user->save();

        // Redirect setelah update berhasil
        return redirect()->route('home')->with('success', 'Profile updated successfully.');
    }
}
