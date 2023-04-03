@extends('layout.main')

@Section('container')
    <h2>Data Jadwal</h2>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <form action="/jadwal" method="get">
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
                <select class="form-control form-control-sm" name="hari" id="hari">
                    <option value="" hidden>Pilih Hari</option>
                    @foreach ($hari->pluck('nama', 'id') as $id => $nama)
                        @if (old('hari') == $id || request('hari') == $id)
                            <option value="{{ $id }}" selected>{{ $nama }}</option>
                        @else
                            <option value="{{ $id }}">{{ $nama }}</option>
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
            <div class="col-2 col-sm-2">
                <button class="btn btn-primary btn-sm" type="submit">Filter</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Nama Mata Pelajaran</th>
                    <th scope="col">Nama Guru</th>
                    <th scope="col">Tahun Ajaran</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Hari</th>
                    <th scope="col">Jam Mulai</th>
                    <th scope="col">Jam Selesai</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_jadwal as $jadwal)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jadwal->kelas->nama }}</td>
                        <td>{{ $jadwal->mapel->nama }}</td>
                        <td>{{ $jadwal->user->nama }}</td>
                        <td>{{ $jadwal->tahun_ajaran->nama }}</td>
                        <td>{{ $jadwal->tahun_ajaran->semester }}</td>
                        <td>{{ $jadwal->hari }}</td>
                        <td>{{ $jadwal->jam_mulai }}</td>
                        <td>{{ $jadwal->jam_selesai }}</td>
                        <td><a href="/jadwal/{{ $jadwal->id }}"><span class="badge text-bg-success">Details</span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
