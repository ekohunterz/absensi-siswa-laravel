<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Mapel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $mapel = Mapel::with('jurusan')
        ->when($request->filled('nama'), function ($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->input('nama') . '%');
        })
        ->when($request->filled('jurusan_id'), function ($query) use ($request) {
            $query->where('jurusan_id', $request->input('jurusan_id'));
        })
        ->paginate(20);

    return view('admin.mapel.index', [
        'title' => 'Data Mata Pelajaran',
        'data_mapel' => $mapel,
        'jurusan' => Jurusan::all()
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mapel.tambah_mapel', [
            'title' => 'Data Mata Pelajaran | Tambah',
            'data_jurusan' => Jurusan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'jurusan_id' => 'required_if:mapel_umum,false',
            'keterangan' => 'nullable|max:255'
        ]);

        Mapel::create($validatedData);
        Alert::success('Tambah Mata Pelajaran', 'Mata Pelajaran berhasil ditambah');
        return redirect('admin/mapel');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mapel $mapel)
    {
        return view('admin.mapel.detail_mapel', [
            'title' => 'Data Mata Pelajaran | Detail',
            'data_mapel' => $mapel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mapel $mapel)
    {
        return view('admin.mapel.edit_mapel', [
            'title' => 'Data Mata Pelajaran | Edit',
            'data_mapel' => $mapel,
            'data_jurusan' => Jurusan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mapel $mapel)
    {
        $rules = [
            'nama' => 'required',
            'jurusan_id' => 'required_if:mapel_umum,false',
            'keterangan' => 'nullable|max:255'
        ];

        $validatedData = $request->validate($rules);


        Mapel::where('id', $mapel->id)->update($validatedData);
        Alert::success('Edit Mata Pelajaran', 'Mata Pelajaran berhasil diedit');
        return redirect('admin/mapel');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapel $mapel)
    {
        Mapel::destroy($mapel->id);
        Alert::success('Hapus Mata Pelajaran', 'Mata Pelajaran berhasil dihapus');
        return redirect('admin/mapel');
    }
}
