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
    $user = auth()->user();
    $jadwalQuery = Jadwal::with('tahun_ajaran', 'kelas', 'user', 'mapel')
        ->when($user->role != 1, function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->when($request->filled('nama'), function ($query) use ($request) {
            $query->join('mapels', 'jadwals.mapel_id', '=', 'mapels.id')
                ->where('mapels.nama', 'like', '%' . $request->nama . '%');
        })
        ->when($request->filled('tahun_id'), function ($query) use ($request) {
            $query->where('tahun_ajaran_id', $request->tahun_id);
        })
        ->when($request->filled('kelas_id'), function ($query) use ($request) {
            $query->where('kelas_id', $request->kelas_id);
        })
        ->when($request->filled('hari'), function ($query) use ($request) {
            $query->where('hari', $request->hari);
        });

    $data_jadwal = $jadwalQuery->paginate(20);

    $class = Kelas::with(['jadwals' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])
        ->get();

    $data_mapel = Mapel::with(['jadwals' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])
        ->get();

    $data_tahun = TahunAjaran::all();

    $viewData = [
        'title' => 'Data Jadwal',
        'data_jadwal' => $data_jadwal,
        'class' => $user->role == 1 ? Kelas::all() : $class,
        'data_mapel' => $data_mapel,
        'data_tahun' => $data_tahun,
        'hari' => $this->day
    ];

    return view($user->role == 1 ? 'admin.jadwal.index' : 'guru.jadwal.index', $viewData);
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
        ], [
            'kelas_id.required' => 'Kelas harus diisi.',
            'mapel_id.required' => 'Mata pelajaran harus diisi.',
            'user_id.required' => 'Guru pengajar harus diisi.',
            'tahun_ajaran_id.required' => 'Tahun ajaran harus diisi.',
            'hari.required' => 'Hari harus diisi.',
            'jam_mulai.required' => 'Jam mulai harus diisi.',
            'jam_selesai.required' => 'Jam selesai harus diisi.',
            'keterangan.required' => 'Keterangan harus diisi.'
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
        $kelas = $jadwal->kelas_id;
        $mapels = Mapel::where(function ($query) use ($kelas) {
            $query->where('jurusan_id', function ($query) use ($kelas) {
                $query->select('jurusan_id')->from('kelas')->where('id', $kelas);
            })->orWhereNull('jurusan_id');
        })->get();

        return view('admin.jadwal.edit_jadwal', [
            'title' => 'Data Jadwal | Edit Jadwal',
            'data_jadwal' => $jadwal,
            'data_mapel' => $mapels,
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
        ], [
            'kelas_id.required' => 'Kelas harus diisi.',
            'mapel_id.required' => 'Mata pelajaran harus diisi.',
            'user_id.required' => 'Guru pengajar harus diisi.',
            'tahun_ajaran_id.required' => 'Tahun ajaran harus diisi.',
            'hari.required' => 'Hari harus diisi.',
            'jam_mulai.required' => 'Jam mulai harus diisi.',
            'jam_selesai.required' => 'Jam selesai harus diisi.',
            'keterangan.required' => 'Keterangan harus diisi.'
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

    public function getJadwalByKelas($id)
    {
        $mapels = Jadwal::join('mapels', 'jadwals.mapel_id', '=', 'mapels.id')->where('jadwals.kelas_id', $id)
                ->select('mapels.nama', 'jadwals.id', 'jadwals.hari')->get();
        return response()->json($mapels);
    }
}
