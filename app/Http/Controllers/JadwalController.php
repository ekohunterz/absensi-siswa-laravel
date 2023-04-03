<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $day;

    public function __construct()
    {

        $this->day = collect([
            ['id' => 'Senin', 'nama' => 'Senin'],
            ['id' => 'Selasa', 'nama' => 'Selasa'],
            ['id' => 'Rabu', 'nama' => 'Rabu'],
            ['id' => 'Kamis', 'nama' => 'Kamis'],
            ['id' => 'Jumat', 'nama' => 'Jumat'],
            ['id' => 'Sabtu', 'nama' => 'Sabtu'],
            ['id' => 'Minggu', 'nama' => 'Minggu'],
        ]);
    }

    public function index(Request $request)
    {

        $user = auth()->user()->id;
        $kelas = $request->input('kelas_id');
        $tahun = $request->input('tahun_id');
        $hari = $request->input('hari');
        $data = [];

        $class = Kelas::join('jadwals', 'kelas.id', '=', 'jadwals.kelas_id')
                ->where('jadwals.user_id', '=', $user)
                ->select('kelas.*', 'jadwals.id as id_jadwal')
                ->distinct()
                ->get();

        $data_mapel = Mapel::join('jadwals', 'mapels.id', '=', 'jadwals.mapel_id')
                    ->where('jadwals.user_id', '=', $user)
                    ->select('mapels.*')
                    ->distinct()
                    ->get();

        $data_tahun = TahunAjaran::all();

        if ($request) {
            $data = Jadwal::query();

        if ($request->filled('tahun_id')) {
            $data->where('tahun_ajaran_id',  $tahun);
        }

        if ($request->filled('kelas_id')) {
            $data->where('kelas_id', $kelas);
        }

        if ($request->filled('hari')) {
            $data->where('hari', $hari);
        }

        $data = $data->paginate(20);
        }

        if (Auth::user()->role != 1) {
            return view('guru.jadwal.index', [
                'title' => 'Data Jadwal',
                'data_jadwal' => $data,
                'class' => $class,
                'data_mapel' => $data_mapel,
                'data_tahun' => $data_tahun,
                'hari' => $this->day
            ]);
        }

        return view('admin.jadwal.index', [
            'title' => 'Data Jadwal',
            'data_jadwal' => $data,
            'class' => Kelas::all(),
            'data_mapel' => Mapel::all(),
            'data_tahun' => $data_tahun,
            'hari' => $this->day
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('admin');
        return view('admin.jadwal.tambah_jadwal', [
            'title' => 'Data Jadwal | Tambah Jadwal',
            'data_mapel' => Mapel::all(),
            'data_user' => User::all(),
            'data_tahun' => TahunAjaran::all(),
            'data_kelas' => Kelas::all(),
            'hari' => $this->day
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('admin');
        $validatedData = $request->validate([
            'kelas_id' => 'required',
            'mapel_id' => 'required',
            'user_id' => 'required',
            'tahun_ajaran_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'keterangan' => 'required'
        ]);
        Jadwal::create($validatedData);
        Alert::success('Tambah Jadwal', 'Jadwal Berhasil ditambah');
        return redirect('jadwal');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {

        return view('admin.jadwal.detail_jadwal', [
            'title' => 'Data Jadwal | Detail Jadwal',
            'data_jadwal' => $jadwal
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        $this->authorize('admin');
        return view('admin.jadwal.edit_jadwal', [
            'title' => 'Data Jadwal | Edit Jadwal',
            'data_jadwal' => $jadwal,
            'data_mapel' => Mapel::all(),
            'data_user' => User::all(),
            'data_tahun' => TahunAjaran::all(),
            'data_kelas' => Kelas::all(),
            'hari' => $this->day
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $this->authorize('admin');
        $validatedData = $request->validate([
            'kelas_id' => 'required',
            'mapel_id' => 'required',
            'user_id' => 'required',
            'tahun_ajaran_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'keterangan' => 'required'
        ]);


        Jadwal::where('id', $jadwal->id)->update($validatedData);
        Alert::success('Edit Jadwal', 'Jadwal Berhasil diedit');
        return redirect('jadwal');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $this->authorize('admin');
        Jadwal::destroy($jadwal->id);
        Alert::success('Hapus Jadwal', 'Jadwal Berhasil dihapus');
        return redirect('jadwal');
    }
}
