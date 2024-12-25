<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Services\SupplierService;
use App\Traits\AutoGenerateCodeTrait;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    use AutoGenerateCodeTrait;

    protected $services;
    protected $kode;

    function __construct(SupplierService $services)
    {
        $this->services = $services;
        $this->kode = $this->generateCode(Supplier::class, 'SP-');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) return $this->services->getDT();

        return view('supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.add', ['kode' => $this->kode]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['kode'] = $this->kode;

        $request->validate(
            [
                'nama' => 'required|min:3',
                'alamat' => 'required',
                'telepon' => 'required|numeric',
            ]
        );

        $data = $this->services->create($request);

        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil disimpan.'),
            'redirectTo' => route('supplier.edit', $data->id)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', ['supplier' => $supplier, 'kode' => $supplier->kode]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {

        $request['kode'] = $supplier->kode;

        $request->validate(
            [
                'nama' => 'required|min:3',
                'alamat' => 'required',
                'telepon' => 'required|numeric',
            ]
        );

        $this->services->update($request, $supplier);

        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil diupdate.'),
            'redirectTo' => route('supplier.edit', $supplier->id)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $this->services->destroy($supplier);

        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil dihapus.')
        ], 200);
    }
}
