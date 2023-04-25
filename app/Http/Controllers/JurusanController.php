<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $jurusan = Jurusan::when($request->filled('nama'), function ($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->input('nama') . '%')->orWhere('kode', 'like', '%' . $request->input('nama') . '%');
        })
        ->paginate(10);

        return view('admin.jurusan.index', [
            'title' => 'Data Jurusan',
            'data_jurusan' => $jurusan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jurusan.tambah_jurusan', [
            'title' => 'Data Jurusan | Tambah Jurusan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nama' => 'required|max:255',
        'kode' => 'required|max:10',
        'keterangan' => 'required|max:255'
    ], [
        'required' => 'Kolom :attribute wajib diisi.',
        'max' => 'Kolom :attribute tidak boleh melebihi :max karakter.',
        'unique' => ':attribute sudah terdaftar untuk jurusan ini.'
    ]);

    Jurusan::create($validatedData);
    Alert::success('Tambah Jurusan', 'Jurusan Berhasil Ditambah');
    return redirect('admin/jurusan');
}

    /**
     * Display the specified resource.
     */
    public function show(jurusan $jurusan)
    {
        return view('admin.jurusan.detail_jurusan', [
            'title' => 'Data Jurusan | Detail',
            'data_jurusan' => $jurusan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jurusan $jurusan)
    {
        return view('admin.jurusan.edit_jurusan', [
            'title' => 'Data Jurusan | Edit',
            'data_jurusan' => $jurusan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, jurusan $jurusan)
    {
        $rules = [
            'nama' => 'required',
            'keterangan' => 'required|max:255'
        ];

        if($request->kode != $jurusan->kode){
            $rules['kode'] = 'required|unique:jurusans';
        }

        $messages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute maksimal :max karakter.',
            'unique' => ':attribute sudah terdaftar.',
        ];

        $validatedData = $request->validate($rules, $messages);


        Jurusan::where('id', $jurusan->id)->update($validatedData);
        Alert::success('Edit Jurusan', 'Jurusan Berhasil diedit');
        return redirect('admin/jurusan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jurusan $jurusan)
    {
        Jurusan::destroy($jurusan->id);
        Alert::success('Hapus Jurusan', 'Jurusan Berhasil diHapus');
        return redirect('admin/jurusan');
    }
}
