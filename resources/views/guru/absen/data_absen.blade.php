@extends('layout.main')

@Section('container')
    <h2>Data Absen</h2>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <form action="/data_absen" method="get">
        <div class="row">
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
            <div class="col-4 col-sm-2">
                <select class="form-control form-control-sm" name="mapel_id" id="mapel_id">
                    <option value="" hidden>Pilih Mapel</option>
                    @foreach ($data_mapel as $mapel)
                        @if (old('mapel_id') == $mapel->id || request('mapel_id') == $mapel->id)
                            <option value="{{ $mapel->id }}" selected>{{ $mapel->nama }}</option>
                        @else
                            <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-4 col-sm-2">
                <input type="date" class="form-control form-control-sm" name="tanggal" id="tanggal"
                    value="{{ request('tanggal') }}">
            </div>
            <div class="col-2 col-sm-2">
                <button class="btn btn-primary btn-sm" type="submit">Pilih</button>
                @if ($data->count())
                    <button class="btn btn-success btn-sm" formaction="/guru/data_absen/export">Export </button>
                @endif
            </div>
        </div>
    </form>

    @if ($data->count())
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $siswa)
                        <tr>
                            <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                            <input type="hidden" name="jadwal_id" value="{{ request('kelas_id') }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $siswa->siswa->nama }}</td>
                            <td>{{ $siswa->siswa->nisn }}</td>
                            <td>{{ $siswa->tanggal }}</td>
                            <td>{{ $siswa->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-md-4">
                <table class="table table-striped table-sm" id="rekap">
                    <tr>
                        <th>Hadir</th>
                        <th>{{ $data->where('status', '=', 'Hadir')->count() }}</th>
                    </tr>
                    <tr>
                        <th>Sakit</th>
                        <th>{{ $data->where('status', '=', 'Sakit')->count() }}</th>
                    </tr>
                    <tr>
                        <th>Izin</th>
                        <th>{{ $data->where('status', '=', 'Izin')->count() }}</th>
                    </tr>
                    <tr>
                        <th>Alpha</th>
                        <th>{{ $data->where('status', '=', 'Alpha')->count() }}</th>
                    </tr>
                </table>
            </div>
        </div>
    @else
        <div class="text-center fs-5 mt-5">Silahkan Pilih Kelas, Mapel dan Tanggal</div>
    @endif
    @if (!empty(request('kelas_id')))
        <script>
            document.getElementById('kelas_id').value = {{ request('kelas_id') }};
            document.getElementById('mapel_id').value = {{ request('mapel_id') }};
        </script>
    @endif
@endsection
