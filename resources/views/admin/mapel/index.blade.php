@extends('layout.main')

@Section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Data Siswa</h6>
                </div>
            </div>
            <form method="GET" action="/admin/mapel/">
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
                                <select class="form-control" name="jurusan_id" id="jurusan_id">
                                    <option value="" hidden>Pilih Jurusan</option>
                                    @foreach ($jurusan as $row)
                                        @if (old('jurusan_id') == $row->id || request('jurusan_id') == $row->id)
                                            <option value="{{ $row->id }}" selected>{{ $row->nama }}</option>
                                        @else
                                            <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-self-end">
                            <button type="submit" class="btn btn-success">Filter</button>
                        </div>
                        <div class="col-md-3 text-end  align-self-end">
                            <a href="/admin/mapel/create" type="button" class="btn btn-primary"><i
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
                                <th scope="col">#</th>
                                <th scope="col">Nama Mata Pelajaran</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_mapel as $mapel)
                                <tr>
                                    <td class="px-4">{{ $loop->iteration }}</td>
                                    <td class="px-4">{{ $mapel->nama }}</td>
                                    <td class="px-4">{{ $mapel->jurusan->nama ?? '-' }}
                                    </td>
                                    <td class="px-4">{{ $mapel->keterangan }}</td>
                                    <td class="px-4">
                                        <a href="/admin/mapel/{{ $mapel->id }}">
                                            <span class="badge bg-gradient-success" title="Lihat Detail">
                                                <i class="fas fa-eye "></i>
                                            </span>
                                        </a>
                                        <a href="/admin/mapel/{{ $mapel->id }}/edit">
                                            <span class="badge bg-gradient-warning" title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                        </a>
                                        <form action="/admin/mapel/{{ $mapel->id }}" method="POST" class="d-inline">
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
    {{ $data_mapel->links() }}
@endsection
