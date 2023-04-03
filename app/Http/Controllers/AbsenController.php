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

    return redirect()->back()->withInput()->with('success', 'Absen berhasil disimpan');
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
        return redirect()->back()->withInput()->with('success', 'Absen berhasil disimpan');
    }

public function data_absen(Request $request){

    $user = auth()->user()->id;
    $kelas = $request->input('kelas_id');
    $tanggal = $request->input('tanggal');
    $mapel = $request->input('mapel_id');
    $data = [];

    if ($request) {
        $data = Absen::join('jadwals', 'absens.jadwal_id', '=', 'jadwals.id')
            ->join('kelas', 'kelas.id', '=', 'jadwals.kelas_id')
            ->join('mapels', 'mapels.id', '=', 'jadwals.mapel_id')
            ->leftjoin('data_siswas', 'data_siswas.id', '=', 'absens.siswa_id')
            ->where('jadwals.mapel_id', '=', $mapel)
            ->where('jadwals.kelas_id', '=', $kelas)
            ->where('absens.tanggal', '=', $tanggal)
            ->orderBy('data_siswas.nama')
            ->get();
    }

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

    if(Auth::user()->role == 1){
        return view('admin.absen.data_absen', [
                    'title' => 'Absen Siswa',
                    'class' => Kelas::all(),
                    'data_mapel' => Mapel::all(),
                    'data' => $data
                    ]);
    }

    return view('guru.absen.data_absen', [
        'title' => 'Absen Siswa',
        'class' => $class,
        'data_mapel' => $data_mapel,
        'data' => $data
    ]);
}

public function data_rekap(Request $request){

    $user = auth()->user()->id;
    $kelas = $request->input('kelas_id');
    $tahun = $request->input('tahun_id');
    $mapel = $request->input('mapel_id');
    $bulan_id = $request->input('bulan_id');
    $data = [];

    if ($request) {
            $query = DB::table('absens as a')
                            ->join('jadwals', 'a.jadwal_id', '=', 'jadwals.id')
                            ->join('kelas', 'kelas.id', '=', 'jadwals.kelas_id')
                            ->join('mapels', 'mapels.id', '=', 'jadwals.mapel_id')
                            ->join('data_siswas as s', 's.id', '=', 'a.siswa_id')
                            ->where('jadwals.mapel_id', '=', $mapel)
                            ->where('jadwals.kelas_id', '=', $kelas)
                            ->where('jadwals.tahun_ajaran_id', '=', $tahun)
                            ->select(DB::raw("count(case when a.status = 'Sakit' then 1 else null end) as tSakit,
                                        count(case when a.status = 'Izin' then 1 else null end) as tIjin,
                                        count(case when a.status = 'Hadir' then 1 else null end) as tHadir,
                                        count(case when a.status != 'Hadir' then 1 else null end) as total,
                                        count(case when a.status = 'Alpha' then 1 else null end) as tAlpha,s.nama"))
                            ->groupBy('s.nama');

                            if(!empty($bulan_id)){
                                $query->whereMonth('a.tanggal', '=', $bulan_id);
                            }
            $data = $query->get();
                    }



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

    if(Auth::user()->role == 1){
        return view('admin.absen.data_rekap', [
                    'title' => 'Rekap Absen Siswa',
                    'class' => Kelas::all(),
                    'data_mapel' => Mapel::all(),
                    'data' => $data,
                    'data_tahun' => $data_tahun,
                    'bulan' => $bulan
                    ]);
    }

    return view('guru.absen.data_rekap', [
        'title' => 'Rekap Absen Siswa',
        'class' => $class,
        'data_mapel' => $data_mapel,
        'data' => $data,
        'data_tahun' => $data_tahun,
        'bulan' => $bulan
    ]);
}


public function export(Request $request)
{
    $kelas = $request->input('kelas_id');
    $tahun = $request->input('tahun_id');
    $mapel = $request->input('mapel_id');
    $data = [];

    if ($request) {
            $query = DB::table('absens as a')
                            ->join('jadwals', 'a.jadwal_id', '=', 'jadwals.id')
                            ->join('kelas', 'kelas.id', '=', 'jadwals.kelas_id')
                            ->join('tahun_ajarans as t', 't.id', '=', 'jadwals.tahun_ajaran_id')
                            ->join('mapels', 'mapels.id', '=', 'jadwals.mapel_id')
                            ->join('data_siswas as s', 's.id', '=', 'a.siswa_id')
                            ->where('jadwals.mapel_id', '=', $mapel)
                            ->where('jadwals.kelas_id', '=', $kelas)
                            ->where('jadwals.tahun_ajaran_id', '=', $tahun)
                            ->select(DB::raw("s.nama, mapels.nama as mapel, t.nama as tahun, t.semester, kelas.nama as kelas,
                                        count(case when a.status = 'Sakit' then 1 else null end) as tSakit,
                                        count(case when a.status = 'Izin' then 1 else null end) as tIjin,
                                        count(case when a.status = 'Hadir' then 1 else null end) as tHadir,
                                        count(case when a.status != 'Hadir' then 1 else null end) as total,
                                        count(case when a.status = 'Alpha' then 1 else null end) as tAlpha"))
                            ->groupBy('s.nama', 'mapel', 'tahun', 't.semester', 'kelas');

                            if(!empty($bulan_id)){
                                $query->whereMonth('a.tanggal', '=', $bulan_id);
                            }
            $data = $query->get();

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
        $data = Absen::join('jadwals', 'absens.jadwal_id', '=', 'jadwals.id')
        ->join('kelas', 'kelas.id', '=', 'jadwals.kelas_id')
        ->join('mapels', 'mapels.id', '=', 'jadwals.mapel_id')
        ->leftjoin('data_siswas', 'data_siswas.id', '=', 'absens.siswa_id')
        ->select('data_siswas.nama as nama_siswa', 'data_siswas.nisn', 'mapels.nama as mapel', 'kelas.nama as kelas', 'absens.*')
        ->where('jadwals.mapel_id', '=', $mapel)
        ->where('jadwals.kelas_id', '=', $kelas)
        ->where('absens.tanggal', '=', $tanggal)
        ->orderBy('data_siswas.nama')->get();

        }

        return Excel::download(new AbsenExport($data), 'absen_' . $tanggal . $kelas . $mapel.'.xls',);
}
}
