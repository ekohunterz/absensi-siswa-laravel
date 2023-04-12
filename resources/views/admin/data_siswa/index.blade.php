@extends('layout.main')

@Section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Data Siswa</h6>
                </div>
            </div>
            <form method="GET" action="/data_siswa">
                <div class="mx-3 my-2">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div
                                class="input-group input-group-outline my-3 {{ request('nama') != '' ? 'is-filled' : '' }}">
                                <label class="form-label">Nama</label>
                                <input class="form-control" type="text" id="nama" name="nama"
                                    value="{{ request('nama') }}">
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div class="input-group input-group-outline my-3">
                                <select class="form-control" name="kelas_id" id="kelas_id">
                                    <option value="" hidden>Pilih Kelas</option>
                                    @foreach ($class as $kelas)
                                        @if (old('kelas_id') == $kelas->id || request('kelas_id') == $kelas->id)
                                            <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}</option>
                                        @else
                                            <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-self-end">
                            <button type="submit" class="btn btn-success">Filter</button>
                            <a href="/data_siswa" class="btn btn-danger ms-2">Reset</a>
                        </div>
                        <div class="col-md-3 text-end  align-self-end">
                            <a href="/data_siswa/create" type="button" class="btn btn-primary"><i
                                    class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Siswa</th>
                                <th>NISN</th>
                                <th>Kelas</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_siswa as $siswa)
                                <tr>
                                    <td class="px-4">{{ $loop->iteration }}</td>
                                    <td class="px-4">{{ $siswa->nama }}</td>
                                    <td class="px-4">{{ $siswa->nisn }}</td>
                                    <td class="px-4">{{ $siswa->kelas->nama }}</td>
                                    <td class="px-4">{{ $siswa->alamat }}</td>
                                    <td class="px-4">
                                        <a href="/data_siswa/{{ $siswa->id }}">
                                            <span class="badge bg-gradient-success" title="Lihat Detail">
                                                <i class="fas fa-eye "></i>
                                            </span>
                                        </a>
                                        <a href="/data_siswa/{{ $siswa->id }}/edit">
                                            <span class="badge bg-gradient-warning" title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                        </a>
                                        <form action="/data_siswa/{{ $siswa->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-gradient-danger border-0"
                                                onclick="return confirm('Apakah anda yakin?')" title="Hapus Data">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $data_siswa->links() }}
@endsection
