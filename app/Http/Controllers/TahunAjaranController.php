<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tahun_ajaran.index', [
            'title' => 'Data Tahun Ajaran',
            'data_tahun' => TahunAjaran::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tahun_ajaran.tambah_tahun', [
            'title' => 'Data Tahun Ajaran | Tambah',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'semester' => 'required',
            'keterangan' => 'required|max:255',
            'is_active' => 'required'
        ]);

        TahunAjaran::create($validatedData);
        Alert::success('Tambah Tahun Ajaran', 'Tahun Ajaran berhasil ditambah');
        return redirect('admin/tahun_ajaran');
    }

    /**
     * Display the specified resource.
     */
    public function show(TahunAjaran $tahunAjaran)
    {
        return view('admin.tahun_ajaran.detail_tahun', [
            'title' => 'Data Tahun Ajaran | Detail',
            'data_tahun' => $tahunAjaran
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TahunAjaran $tahunAjaran)
    {
        return view('admin.tahun_ajaran.edit_tahun', [
            'title' => 'Data Tahun Ajaran | Edit',
            'data_tahun' => $tahunAjaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        $rules = [
            'nama' => 'required',
            'semester' => 'required',
            'keterangan' => 'required|max:255',
            'is_active' => 'required'
        ];

        $validatedData = $request->validate($rules);


        TahunAjaran::where('id', $tahunAjaran->id)->update($validatedData);
        Alert::success('Edit Tahun Ajaran', 'Tahun Ajaran berhasil diedit');
        return redirect('admin/tahun_ajaran');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TahunAjaran $tahunAjaran)
    {
        TahunAjaran::destroy($tahunAjaran->id);
        Alert::success('Hapus Tahun Ajaran', 'Tahun Ajaran berhasil dihapus');
        return redirect('admin/tahun_ajaran');
    }
}
