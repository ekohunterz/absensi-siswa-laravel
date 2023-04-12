@extends('layout.main')

@Section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Data Guru</h6>
                </div>
            </div>
            <form method="GET" action="/admin/data_guru">
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
                                <select class="form-control" name="status" id="status">
                                    <option value="" hidden>Pilih Status</option>
                                    <option value="PNS" {{ request('status') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                    <option value="Honorer" {{ request('status') == 'Honorer' ? 'selected' : '' }}>Honorer
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-self-end">
                            <button type="submit" class="btn btn-success">Filter</button>
                            <a href="/admin/data_guru" class="btn btn-danger ms-2">Reset</a>
                        </div>
                        <div class="col-md-3 text-end  align-self-end">
                            <a href="/admin/data_guru/create" type="button" class="btn btn-primary"><i
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
                                <th scope="col">Nama Guru</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_guru as $guru)
                                <tr>
                                    <td class="px-4">{{ $loop->iteration }}</td>
                                    <td class="px-4">{{ $guru->nama }}</td>
                                    <td class="px-4">{{ $guru->nip }}</td>
                                    <td class="px-4 text-wrap">{{ $guru->alamat }}</td>
                                    <td class="px-4">{{ $guru->status }}</td>
                                    <td class="px-4">
                                        <a href="/admin/data_guru/{{ $guru->id }}">
                                            <span class="badge bg-gradient-success" title="Lihat Detail">
                                                <i class="fas fa-eye "></i>
                                            </span>
                                        </a>
                                        <a href="/admin/data_guru/{{ $guru->id }}/edit">
                                            <span class="badge bg-gradient-warning" title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                        </a>
                                        <form action="/admin/data_guru/{{ $guru->id }}" method="POST"
                                            class="d-inline">
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
    {{ $data_guru->links() }}
@endsection
