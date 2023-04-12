<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
                'password' => 'same:nip',
                'status' => 'required'
            ]);
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
                'email' => 'required',
                'status' => 'required'
        ];

        if($request->nip != $data_guru->nip){
            $rules['nip'] = 'required|unique:users|max:18';
        }

        $validatedData = $request->validate($rules);
        User::where('id', $data_guru->id)->update($validatedData);
        Alert::success('Edit Guru', 'Guru berhasil diedit');
        return redirect('admin/data_guru');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $data_guru)
    {
        User::destroy($data_guru->id);
        Alert::success('Hapus Guru', 'Guru berhasil dihapus');
        return redirect('admin/data_guru');
    }

    public function profile(Request $request)
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
        $data_guru = User::where('id', $user->id)
                    ->first();
        $rules = [
                'nama' => 'required|max:255',
                'alamat' => 'required|max:255',
                'no_HP' => 'required',
                'email' => 'required'
        ];

        if($request->nip != $data_guru->nip){
            $rules['nip'] = 'required|unique:users|max:18';
        }

        $validatedData = $request->validate($rules);
        User::where('id', $user->id)->update($validatedData);
        Alert::success('Edit Profile', 'Profile berhasil diedit');
        return redirect('profile');
    }
}
