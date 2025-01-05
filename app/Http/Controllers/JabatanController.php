<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JabatanController extends Controller
{
    private $jabatans;

    function __construct()
    {
        $this->jabatans = Jabatan::getAllJabatan();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        return view('jabatan.index', [ 'jabatans' => $this->jabatans ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jabatan.add', [
            'jabatans' => $this->jabatans,
            'jabatan' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:jabatan,id',
            'deskripsi' => 'nullable|string|max:255',
        ]);
    
        // Menyimpan data jabatan baru
        $jabatan = new Jabatan();
        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->parent_id = $request->parent_id === 'null' ? null : $request->parent_id; // Menangani null jika 'None' dipilih
        $jabatan->deskripsi = $request->deskripsi;
        $jabatan->save();

        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil disimpan.'),
            'redirectTo' => route('jabatan.index')
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        //
        return view('jabatan.edit', [
            'jabatans' => $this->jabatans,
            'jabatan' => $jabatan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        //
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:jabatan,id',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->parent_id = $request->parent_id === 'null' ? null : $request->parent_id; // Menangani null jika 'None' dipilih
        $jabatan->deskripsi = $request->deskripsi;
        $jabatan->save();

        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil diubah.'),
            'redirectTo' => route('jabatan.index')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        //
        $jabatan->delete();

        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil dihapus.')
        ], 200);
    }
}
