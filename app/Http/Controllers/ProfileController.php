<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user(); // Ambil user yang sedang login

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:15',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Proses upload gambar
        if ($request->hasFile('profile_image')) {
            // Hapus file lama jika ada
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $image_path = $request->file('profile_image')->store('photos', 'public');
            $validated['profile_image'] = $image_path;
        }

        $user->update($validated);

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
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
