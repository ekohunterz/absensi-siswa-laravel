<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $guru = User::query()
        ->where('role', 2)
        ->when($request->filled('nama'), function ($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->input('nama') . '%');
        })
        ->when($request->filled('status'), function ($query) use ($request) {
            $query->where('status', $request->input('status'));
        })
        ->paginate(10);

    return view('admin.data_guru.index', [
        'title' => 'Data Guru',
        'data_guru' => $guru
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data_guru.tambah_guru', [
            'title' => 'Data Guru | Tambah Guru',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
            $validatedData = $request->validate([
                'nama' => 'required|max:255',
                'nip' => 'required|unique:users|max:18',
                'alamat' => 'required|max:255',
                'no_HP' => 'required',
                'email' => 'required',
                'tgl_lahir' => 'required',
                'password' => 'same:nip',
                'status' => 'required'
            ], [
                'required' => ':attribute wajib diisi.',
                'max' => ':attribute maksimal :max karakter.',
                'unique' => ':attribute sudah terdaftar.',
            ], [
                'nama' => 'Nama lengkap',
                'nip' => 'NIP',
                'alamat' => 'Alamat',
                'no_HP' => 'Nomor HP',
                'email' => 'Email',
                'tgl_lahir' => 'Tanggal Lahir',
                'password' => 'Password',
                'status' => 'Status']);

            $validatedData['role'] = '2';
            $validatedData['password'] = bcrypt($validatedData['nip']);
            User::create($validatedData);
            Alert::success('Tambah Guru', 'Guru berhasil ditambah');
            return redirect('admin/data_guru');
        }

    /**
     * Display the specified resource.
     */
    public function show(User $data_guru)
    {
        return view('admin.data_guru.detail_guru', [
            'title' => 'Data Guru | Detail Guru',
            'data_guru' => $data_guru
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $data_guru)
    {
        return view('admin.data_guru.edit_guru', [
            'title' => 'Data Guru | Detail',
            'data_guru' => $data_guru
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $data_guru)
    {
        $rules = [
                'nama' => 'required|max:255',
                'alamat' => 'required|max:255',
                'no_HP' => 'required',
                'tgl_lahir' => 'required',
                'email' => 'required',
                'status' => 'required'
        ];

        if($request->nip != $data_guru->nip){
            $rules['nip'] = 'required|unique:users|max:18';
        }

        $messages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute maksimal :max karakter.',
            'unique' => ':attribute sudah terdaftar.',
        ];

        $attributes = [
            'nama' => 'Nama',
            'nip' => 'NIP',
            'alamat' => 'Alamat',
            'no_HP' => 'No. HP',
            'tgl_lahir' => 'Tanggal Lahir',
            'email' => 'Email',
            'status' => 'Status',
        ];

        $validatedData = $request->validate($rules, $messages, $attributes);
        User::where('id', $data_guru->id)->update($validatedData);
        Alert::success('Edit Guru', 'Guru berhasil diedit');
        return redirect('admin/data_guru');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $data_guru)
    {
        if($data_guru->foto){
            Storage::delete('foto-profil/'.$data_guru->foto);
        }

        User::destroy($data_guru->id);
        Alert::success('Hapus Guru', 'Guru berhasil dihapus');
        return redirect('admin/data_guru');
    }

    public function profile()
    {
    $user = auth()->user();
    $guru = User::where('id', $user->id)
        ->first();

    return view('dashboard.profile', [
        'title' => 'Profile',
        'data_guru' => $guru
    ]);
    }

    public function update_profile(Request $request)
    {
    $user = auth()->user();

    $rules = [
        'nama' => 'required|max:255',
        'alamat' => 'required|max:255',
        'no_HP' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'tgl_lahir' => 'required',
        'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // tambahkan validasi untuk file foto
    ];

    $messages = [
        'required' => ':attribute wajib diisi.',
        'max' => ':attribute maksimal :max karakter.',
        'email' => ':attribute harus berupa email.',
        'unique' => ':attribute telah digunakan oleh pengguna lain.',
        'image' => ':attribute harus berupa gambar.',
        'mimes' => ':attribute harus berupa file dengan tipe: :values.',
        'max' => ':attribute maksimal :max KB.',
    ];

    $attributes = [
        'nama' => 'Nama',
        'alamat' => 'Alamat',
        'no_HP' => 'No. HP',
        'tgl_lahir' => 'Tanggal Lahir',
        'email' => 'Email',
        'foto' => 'Foto Profil'
    ];


    $validatedData = $request->validate($rules, $messages, $attributes);

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('foto-profil', $fileName);
        $validatedData['foto'] = $fileName;

        if($user->foto){
            Storage::delete('foto-profil/'.$user->foto);
        }
    }

    User::where('id', $user->id)->update($validatedData);

    Alert::success('Edit Profile', 'Profile berhasil diedit');
    return redirect('profile');
    }

    public function ubah_pass()
    {
    return view('dashboard.change-password', [
        'title' => 'Ubah Password'
    ]);
    }

    public function changePassword(Request $request)
{
    $this->validate($request, [
        'old_password' => 'required',
        'password' => 'required|min:6|confirmed',
    ],
    [
        'required' => ':attribute wajib diisi.',
        'min' => ':attribute minimal :min karakter.',
    ],[

        'password' => 'Password',
        'old_password' => 'Password Lama',
    ]);

    $user = Auth::user();
    $hashedPassword = $user->password;

    if (Hash::check($request->old_password, $hashedPassword)) {
        $user->fill([
            'password' => Hash::make($request->password)
        ])->save();

        Auth::logout();

        return redirect()->route('login')->with('successMsg', 'Password berhasil diubah, silakan login kembali.');
    }

    return back()->withErrors(['old_password' => 'Password lama salah!!.']);
}
}
