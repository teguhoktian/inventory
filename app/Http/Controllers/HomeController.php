<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluarDetail;
use App\Models\BarangMasukDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $barangs = Barang::get();
        $barangMasuk = BarangMasukDetail::selectRaw('*, quantity * harga AS total')->get();
        $barangKeluar = BarangKeluarDetail::selectRaw('*, quantity * harga AS total')->get();
        return view('home', ['barangs' => $barangs, 'barangMasuk' => $barangMasuk, 'barangKeluar' => $barangKeluar]);
    }

    public function profile()
    {
        return view('profile.show');
    }

    // public function editProfile()
    // {
    //     return view('profile.edit');
    // }

    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'password' => 'nullable|confirmed|min:6',
            'password_confirmation' => 'nullable',
            'image_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file gambar
        ]);

        $user = Auth::user();

        // Proses password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update data user kecuali password dan image_profile
        $user->update($request->except(['password', 'password_confirmation', 'image_profile']));

        // Proses unggah gambar profil
        if ($request->hasFile('image_profile')) {
            // Hapus gambar lama jika ada
            if ($user->hasMedia('profile_image')) {
                $user->clearMediaCollection('profile_image');
            }

            // Tambahkan gambar baru
            $user->addMedia($request->file('image_profile'))
                ->toMediaCollection('profile_image');
        }

        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil disimpan.'),
            'redirectTo' => route('profile.me'),
        ], 200);
    }
}
