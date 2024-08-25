<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluarDetail;
use App\Models\BarangMasukDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function editProfile()
    {
        return view('profile.edit');
    }

    public function updateProfile(Request $request)
    {
        //validate $request
        $request->validate([
            'password' => 'nullable|confirmed|min:6',
            'password_confirmation' => 'nullable',
        ]);

        if (is_null($request['password'])) {
            $request['password'] = Auth::user()->password;
        } else {
            $request['password'] = \Illuminate\Support\Facades\Hash::make($request['password']);
        }
        $user = Auth::user()->update($request->all());

        return redirect()->route('profile.me');
    }
}
