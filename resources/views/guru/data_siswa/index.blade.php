@extends('layout.main')

@Section('container')
    <h2>Data Siswa</h2>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <form method="GET" action="/data_siswa">
        <div class="row">
            <div class="col-3 col-sm-2">
                <input class="form-control form-control-sm" type="text" id="nama" name="nama" placeholder="Nama"
                    value="{{ request('nama') }}">
            </div>
            <div class="col-3 col-sm-2">
                <select class="form-control form-control-sm" name="kelas_id" id="kelas_id">
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
            <div class="col-3 col-sm-2">
                <button type="submit" class="btn btn-success btn-sm">Filter</button>
            </div>
        </div>

    </form>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">NISN</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_siswa as $siswa)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $siswa->nama }}</td>
                        <td>{{ $siswa->nisn }}</td>
                        <td>{{ $siswa->kelas->nama }}</td>
                        <td>{{ $siswa->alamat }}</td>
                        <td><a href="/data_siswa/{{ $siswa->id }}"><span
                                    class="badge text-bg-success">Details</span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $data_siswa->links() }}
@endsection
