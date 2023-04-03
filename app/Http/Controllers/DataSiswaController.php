<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use App\Models\Kelas;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $siswa = DataSiswa::query();

        if ($request->filled('nama')) {
            $siswa->where('nama', 'like', '%' . $request->input('nama') . '%');
        }

        if ($request->filled('kelas_id')) {
            $siswa->where('kelas_id', $request->input('kelas_id'));
        }

        $siswa = $siswa->paginate(20);

        if (Auth::user()->role != 1) {
            // jika tidak, tampilkan halaman yang sesuai
            return view('guru.data_siswa.index', [
                'title' => 'Data Siswa',
                'data_siswa' => $siswa,
                'class' => Kelas::all()
            ]);
        }

        return view('admin.data_siswa.index', [
            'title' => 'Data Siswa',
            'data_siswa' => $siswa,
            'class' => Kelas::all()
        ]);
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('admin');
        return view('admin.data_siswa.tambah_siswa', [
            'title' => 'Data Siswa | Tambah Siswa',
            'class' => Kelas::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('admin');
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'nisn' => 'required|unique:data_siswas|max:10',
            'alamat' => 'required|max:255',
            'no_HP' => 'required',
            'kelas_id' => 'required'
        ]);

        DataSiswa::create($validatedData);
        Alert::success('Tambah Siswa', 'Siswa Berhasil Ditambah');
        return redirect('data_siswa');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataSiswa $dataSiswa)
    {
        return view('admin.data_siswa.detail_siswa', [
            'title' => 'Data Siswa | Detail Siswa',
            'data_siswa' => $dataSiswa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataSiswa $dataSiswa)
    {
        $this->authorize('admin');
        return view('admin.data_siswa.edit_siswa', [
            'title' => 'Data Siswa | Edit Siswa',
            'data_siswa' => $dataSiswa,
            'class' => Kelas::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataSiswa $dataSiswa)
    {
        $this->authorize('admin');
        $rules = [
            'nama' => 'required|max:255',
            'alamat' => 'required|max:255',
            'no_HP' => 'required',
            'kelas_id' => 'required'
        ];

        if($request->nisn != $dataSiswa->nisn){
            $rules['nisn'] = 'required|unique:data_siswas|max:10';
        }

        $validatedData = $request->validate($rules);


        DataSiswa::where('id', $dataSiswa->id)->update($validatedData);
        Alert::success('Edit Siswa', 'Siswa Berhasil diedit');
        return redirect('data_siswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataSiswa $dataSiswa)
    {
        $this->authorize('admin');
        DataSiswa::destroy($dataSiswa->id);
        Alert::success('Hapus Siswa', 'Siswa Berhasil Dihapus');
        return redirect('data_siswa');
    }
}
