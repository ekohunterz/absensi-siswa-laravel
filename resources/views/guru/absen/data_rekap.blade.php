@extends('layout.main')

@Section('container')
    <h2>Data Rekap</h2>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <form action="/data_rekap" method="get">
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
                <select class="form-control form-control-sm" name="tahun_id" id="tahun_id">
                    <option value="" hidden>Pilih Tahun Ajaran</option>
                    @foreach ($data_tahun as $tahun)
                        @if (old('tahun_id') == $tahun->id || request('tahun_id') == $tahun->id)
                            <option value="{{ $tahun->id }}" selected>{{ $tahun->nama }} - {{ $tahun->semester }}
                            </option>
                        @else
                            <option value="{{ $tahun->id }}">{{ $tahun->nama }} - {{ $tahun->semester }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-4 col-sm-2">
                <select class="form-control form-control-sm" name="bulan_id" id="bulan_id">
                    <option value="" hidden>Pilih Bulan </option>
                    @foreach ($bulan->pluck('nama', 'id') as $id => $nama)
                        @if (old('bulan_id') == $id || request('bulan_id') == $id)
                            <option value="{{ $id }}" selected>{{ $nama }}</option>
                        @else
                            <option value="{{ $id }}">{{ $nama }}</option>
                        @endif
                    @endforeach
                </select>
                <p class="link-danger">
                    *Opsional
                </p>
            </div>
            <div class="col-2 col-sm-2">
                <button class="btn btn-primary btn-sm" type="submit">Pilih</button>
                @if ($data->count())
                    <button class="btn btn-success btn-sm" formaction="/guru/data_rekap/export">Export </button>
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
                        <th scope="col">Hadir</th>
                        <th scope="col">Alpha</th>
                        <th scope="col">Sakit</th>
                        <th scope="col">Izin</th>
                        <th scope="col">Total Tidak Hadir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $siswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->tHadir }}</td>
                            <td>{{ $siswa->tAlpha }}</td>
                            <td>{{ $siswa->tSakit }}</td>
                            <td>{{ $siswa->tIjin }}</td>
                            <td>{{ $siswa->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center fs-5 mt-5">Silahkan Pilih Kelas, Mapel dan Tahun Ajaran</div>
    @endif
@endsection
