<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\DataSiswa;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapExport;
use App\Exports\AbsenExport;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AbsenController extends Controller
{
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $hari_ini = Carbon::now()->translatedFormat('l');
        $jadwal_id = $request->input('jadwal_id');
        $tanggal = Carbon::now()->format('Y-m-d');
        $data = [];

        if ($jadwal_id) {
            $data = DataSiswa::join('jadwals', 'data_siswas.kelas_id', '=', 'jadwals.kelas_id')
                ->leftJoin('absens', function ($join) use ($tanggal) {
                    $join->on('data_siswas.id', '=', 'absens.siswa_id')
                        ->where('absens.tanggal', '=', $tanggal);
                })
                ->where('jadwals.id', '=', $jadwal_id)
                ->select('data_siswas.*', 'absens.status')
                ->orderBy('data_siswas.nama')
                ->get();
        }

        $kelas = Kelas::join('jadwals', 'kelas.id', '=', 'jadwals.kelas_id')
            ->where('jadwals.hari', '=', $hari_ini)
            ->where('jadwals.user_id', '=', $user_id)
            ->select('kelas.*', 'jadwals.id as id_jadwal')
            ->distinct()
            ->get();

        return view('guru.absen.index', [
            'title' => 'Absen Siswa',
            'class' => $kelas,
            'data' => $data
        ]);
    }

    public function store(Request $request)
{
    $siswa_id = $request->siswa_id;
    $status = $request->status;
    $jadwal_id = $request->jadwal_id;
    $tanggal = Carbon::now()->format('Y-m-d');

    foreach($siswa_id as $key => $id) {
        Absen::updateOrCreate(
            ['siswa_id' => $id, 'tanggal' => $tanggal],
            ['jadwal_id' => $jadwal_id, 'status' => $status[$id]]
        );
    }
    Alert::success('Sukses', 'Absen berhasil disimpan');
    return redirect()->back()->withInput();
}

public function update(Request $request)
    {
        $this->authorize('admin');
        $siswa_id = $request->siswa_id;
        $status = $request->status;
        $jadwal_id = $request->jadwal_id;
        $tanggal = $request->tanggal;

        foreach($siswa_id as $key => $id) {
        Absen::updateOrCreate(
            ['siswa_id' => $id, 'tanggal' => $tanggal],
            ['jadwal_id' => $jadwal_id, 'status' => $status[$key]]
        );
    }
        Alert::success('Sukses', 'Absen berhasil disimpan');
        return redirect()->back()->withInput();
    }

public function data_absen(Request $request){

    $user = auth()->user();
    $kelas = $request->input('kelas_id');
    $tanggal = $request->input('tanggal');
    $mapel = $request->input('mapel_id');
    $data = [];

    $data = Absen::with(['jadwal.kelas', 'jadwal.mapel', 'siswa'])
        ->whereHas('jadwal', function ($query) use ($mapel, $kelas) {
            $query->where('mapel_id', $mapel)->where('kelas_id', $kelas);
        })
        ->where('tanggal', $tanggal)
        ->get();

    $class = Kelas::whereHas('jadwals', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->distinct()
        ->get();

    $data_mapel = Mapel::whereHas('jadwals', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->distinct()
        ->get();

        $viewData = [
            'title' => 'Data Jadwal',
            'data' => $data,
            'class' => $user->role == 1 ? Kelas::all() : $class,
            'data_mapel' => $user->role == 1 ? Mapel::all() : $data_mapel
        ];

        return view($user->role == 1 ? 'admin.absen.data_absen' : 'guru.absen.data_absen', $viewData);
}

public function data_rekap(Request $request){

    $user = auth()->user();
    $kelas = $request->input('kelas_id');
    $tahun = $request->input('tahun_id');
    $mapel = $request->input('mapel_id');
    $bulan_id = $request->input('bulan_id');
    $data = [];

    if ($request) {
        $data = Absen::with('siswa')
        ->join('jadwals', 'absens.jadwal_id', '=', 'jadwals.id')
        ->where('jadwals.mapel_id', '=', $mapel)
        ->where('jadwals.kelas_id', '=', $kelas)
        ->where('jadwals.tahun_ajaran_id', '=', $tahun)
        ->select(DB::raw("count(case when absens.status = 'Sakit' then 1 else null end) as tSakit,
        count(case when absens.status = 'Izin' then 1 else null end) as tIjin,
        count(case when absens.status = 'Hadir' then 1 else null end) as tHadir,
        count(case when absens.status != 'Hadir' then 1 else null end) as total,
        count(case when absens.status = 'Alpha' then 1 else null end) as tAlpha, absens.siswa_id"))
        ->groupBy('absens.siswa_id');

        if (!empty($bulan_id)) {
            $data->whereMonth('absens.tanggal', '=', $bulan_id);
        }
            $data->join('data_siswas', 'absens.siswa_id', '=', 'data_siswas.id')
                 ->orderBy('data_siswas.nama', 'asc');

        $data = $data->get();
    }



    $class = Kelas::join('jadwals', 'kelas.id', '=', 'jadwals.kelas_id')
                ->where('jadwals.user_id', '=', $user->id)
                ->select('kelas.*', 'jadwals.id as id_jadwal')
                ->distinct()
                ->get();

    $data_mapel = Mapel::join('jadwals', 'mapels.id', '=', 'jadwals.mapel_id')
                    ->where('jadwals.user_id', '=', $user->id)
                    ->select('mapels.*')
                    ->distinct()
                    ->get();

    $data_tahun = TahunAjaran::all();

    $bulan = collect([
        ['id' => '01', 'nama' => 'Januari'],
        ['id' => '02', 'nama' => 'Februari'],
        ['id' => '03', 'nama' => 'Maret'],
        ['id' => '04', 'nama' => 'April'],
        ['id' => '05', 'nama' => 'Mei'],
        ['id' => '06', 'nama' => 'Juni'],
        ['id' => '07', 'nama' => 'Juli'],
        ['id' => '08', 'nama' => 'Agustus'],
        ['id' => '09', 'nama' => 'September'],
        ['id' => '10', 'nama' => 'Oktober'],
        ['id' => '11', 'nama' => 'November'],
        ['id' => '12', 'nama' => 'Desember'],
    ]);

    $viewData = [
        'title' => 'Rekap Absen Siswa',
        'data' => $data,
        'class' => $user->role == 1 ? Kelas::all() : $class,
        'data_mapel' => $user->role == 1 ? Mapel::all() : $data_mapel,
        'data_tahun' => $data_tahun,
        'bulan' => $bulan
        ];

        return view($user->role == 1 ? 'admin.absen.data_rekap' : 'guru.absen.data_rekap', $viewData);
}


public function export(Request $request)
{
    $kelas = $request->input('kelas_id');
    $tahun = $request->input('tahun_id');
    $mapel = $request->input('mapel_id');
    $data = [];

    if ($request) {
        $data = Absen::with('siswa', 'jadwal.mapel', 'jadwal.tahun_ajaran')
        ->join('jadwals', 'absens.jadwal_id', '=', 'jadwals.id')
        ->where('jadwals.mapel_id', '=', $mapel)
        ->where('jadwals.kelas_id', '=', $kelas)
        ->where('jadwals.tahun_ajaran_id', '=', $tahun)
        ->select(DB::raw("count(case when absens.status = 'Sakit' then 1 else null end) as tSakit,
        count(case when absens.status = 'Izin' then 1 else null end) as tIjin,
        count(case when absens.status = 'Hadir' then 1 else null end) as tHadir,
        count(case when absens.status != 'Hadir' then 1 else null end) as total,
        count(case when absens.status = 'Alpha' then 1 else null end) as tAlpha, absens.siswa_id, absens.jadwal_id"))
        ->groupBy('absens.siswa_id', 'absens.jadwal_id');

        if (!empty($bulan_id)) {
            $data->whereMonth('absens.tanggal', '=', $bulan_id);
        }

        $data->join('data_siswas', 'absens.siswa_id', '=', 'data_siswas.id')
             ->orderBy('data_siswas.nama', 'asc');
        $data = $data->get();

        }

        return Excel::download(new RekapExport($data), 'rekap_' . Carbon::now()->format('Ymd') . $kelas . $mapel.'.xls',);
}

public function export_hadir(Request $request)
{
    $kelas = $request->input('kelas_id');
    $tanggal = $request->input('tanggal');
    $mapel = $request->input('mapel_id');
    $data = [];

    if ($request) {
        $data = Absen::with('jadwal.kelas', 'jadwal.mapel', 'siswa')
            ->whereHas('jadwal', function ($query) use ($mapel, $kelas) {
                $query->where('mapel_id', $mapel)->where('kelas_id', $kelas);
            })
            ->where('tanggal', $tanggal)
            ->get();
    }

        return Excel::download(new AbsenExport($data), 'absen_' . $tanggal . $kelas . $mapel.'.xls',);
}
}
