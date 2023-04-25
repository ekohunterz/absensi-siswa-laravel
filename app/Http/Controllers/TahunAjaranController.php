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
    public function index(Request $request)
    {
        $tahun = TahunAjaran::when($request->filled('nama'), function ($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->input('nama') . '%')->orWhere('semester', 'like', '%' . $request->input('nama') . '%');
        })
        ->paginate(20);

        return view('admin.tahun_ajaran.index', [
            'title' => 'Data Tahun Ajaran',
            'data_tahun' => $tahun
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
        ],[
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute maksimal :max karakter.'
        ],[
            'nama' => 'Nama Tahun Ajaran',
            'semester' => 'Semester',
            'keterangan' => 'Keterangan',
            'is_active' => 'Status'
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

        $messages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute maksimal :max karakter.'
        ];

        $validatedData = $request->validate($rules, $messages, [
            'nama' => 'Nama Tahun Ajaran',
            'semester' => 'Semester',
            'keterangan' => 'Keterangan',
            'is_active' => 'Status'
        ]);

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
