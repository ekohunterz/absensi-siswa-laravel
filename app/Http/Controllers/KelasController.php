<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kelas = Kelas::query();

        if ($request->filled('nama')) {
            $kelas->where('nama', 'like', '%' . $request->input('nama') . '%');
        }

        if ($request->filled('jurusan_id')) {
            $kelas->where('jurusan_id', $request->input('jurusan_id'));
        }

        $kelas = $kelas->paginate(20);
        return view('admin.kelas.index', [
            'title' => 'Data Kelas',
            'data_kelas' => $kelas,
            'jurusan' => Jurusan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelas.tambah_kelas', [
            'title' => 'Data Kelas | Tambah',
            'data_jurusan' => Jurusan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|unique:kelas',
            'jurusan_id' => 'required',
            'keterangan' => 'required|max:255'
        ]);

        Kelas::create($validatedData);
        Alert::success('Tambah Kelas', 'Kelas berhasil ditambah');
        return redirect('admin/kelas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kela)
    {
        return view('admin.kelas.detail_kelas', [
            'title' => 'Data Kelas | Detail',
            'data_kelas' => $kela
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kela)
    {
        return view('admin.kelas.edit_kelas', [
            'title' => 'Data Kelas | Edit',
            'data_kelas' => $kela,
            'data_jurusan' => Jurusan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kela)
    {
        $rules = [
            'jurusan_id' => 'required',
            'keterangan' => 'required|max:255'
        ];

        if($request->nama != $kela->nama){
            $rules['nama'] = 'required|unique:kelas';
        }

        $validatedData = $request->validate($rules);


        Kelas::where('id', $kela->id)->update($validatedData);
        Alert::success('Edit Kelas', 'Kelas berhasil diedit');
        return redirect('admin/kelas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kela)
    {
        Kelas::destroy($kela->id);
        Alert::success('Hapus Kelas', 'Kelas berhasil dihapus');
        return redirect('admin/kelas');
    }
}
