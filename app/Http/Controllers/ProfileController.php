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
            'alamat' => 'required|string|max:255',
        ]);

        // Update data pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number; // Update nomor telepon jika ada
        $user->alamat = $request->alamat; // Update alamat


        // Proses jika ada gambar baru
        if ($request->hasFile('profile_image')) {
            // Simpan gambar baru ke storage/app/public/photos
            $path = $request->file('profile_image')->store('photos', 'public');
            // Hapus gambar lama jika ada dan berbeda dengan yang baru
            if ($user->profile_image && $user->profile_image !== $path && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $user->profile_image = $path; // Simpan path relatif (misal: photos/namafile.jpg)
        }

        // Simpan perubahan data pengguna
        $user->save();

        // Redirect setelah update berhasil
        return redirect()->route('home')->with('success', 'Profile updated successfully.');
    }

    public function showSavedAddresses()
    {
        $user = Auth::user();

        // Ambil alamat yang sudah disimpan dari database atau session
        $savedAddresses = $user->alamat ?? []; // Asumsikan ada relasi addresses

        return view('saved_addresses', compact('savedAddresses'));
    }

    // public function updateAddress(Request $request, $id)
    // {
    //     // Validasi data
    //     $validated = $request->validate([
    //         'alamat' => 'required|string|max:255',
    //         'kode_pos' => 'required|string|max:10',
    //         'nama' => 'required|string|max:255',
    //         'no_telp' => 'required|string|max:15',
    //         'pin_alamat' => 'required|string|max:10',
    //     ]);

    //     // Cari alamat berdasarkan ID dan update
    //     $address = Auth::user()->addresses()->findOrFail($id);
    //     $address->update($validated);

    //     // Redirect kembali ke halaman alamat tersimpan
    //     return redirect()->route('profile.savedAddresses')->with('success', 'Alamat berhasil diperbarui!');
    // }
}
