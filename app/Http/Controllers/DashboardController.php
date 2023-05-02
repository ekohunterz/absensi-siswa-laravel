<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\DataSiswa;
use App\Models\Jadwal;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $hari_ini = Carbon::now()->translatedFormat('l');
        $user_id = auth()->user()->id;
        $now = Carbon::now()->format('H:i:s');

        $jadwal_now = Jadwal::with('kelas', 'mapel', 'user', 'tahun_ajaran')->where('hari', '=', $hari_ini)
                            ->where('user_id', '=', $user_id)
                            ->where('is_active', true)
                            ->whereTime('jam_mulai', '>=', $now)
                            ->whereTime('jam_selesai', '<=', $now)
                            ->whereHas('tahun_ajaran', function($query) {
                                $query->where('is_active', true);
                            })
                            ->first();

        $jadwal_all = Jadwal::with('kelas', 'mapel', 'user', 'tahun_ajaran')
                            ->where('hari', '=', $hari_ini)
                            ->where('is_active', true)
                            ->whereHas('tahun_ajaran', function($query) {
                                $query->where('is_active', true);
                            })
                            ->when(Auth::user()->role == 2, function ($query) use ($user_id) {
                                return $query->where('jadwals.user_id', $user_id);
                            })->get();

        $absensi = [];
        foreach ($jadwal_all as $jdwl) {
            $absensi[$jdwl->id] = Absen::where('jadwal_id', $jdwl->id)
                                        ->where('tanggal',Carbon::now()->format('Y-m-d'))
                                        ->exists();
        }

        $tidak_hadir = Absen::with('siswa.kelas', 'jadwal.mapel')->join('jadwals', 'absens.jadwal_id', '=', 'jadwals.id')
                            ->where('absens.status', '!=', 'Hadir')
                            ->where('absens.tanggal', Carbon::now()->format('Y-m-d'))
                            ->when(Auth::user()->role == 2, function ($query) use ($user_id) {
                                return $query->where('jadwals.user_id', $user_id);
                                })->paginate(5);

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'siswa' => DataSiswa::all()->count(),
            'guru' => User::where('role', '=', 2)->count(),
            'kelas' => Kelas::all()->count(),
            'jurusan' => Jurusan::all()->count(),
            'jadwal' => $jadwal_now,
            'jadwal_all' => $jadwal_all,
            'absensi' => $absensi,
            'jumlah_ngajar' => Jadwal::where('user_id', '=', $user_id)->count(),
            'tahun_ajaran' => TahunAjaran::where('is_active', '=', 1)->first(),
            'tidak_hadir' => $tidak_hadir
        ]);
    }
}
