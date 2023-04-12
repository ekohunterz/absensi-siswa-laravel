@extends('layout.main')

@Section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Data Jadwal</h6>
                </div>
            </div>
            <form action="/jadwal" method="get">
                <div class="mx-3 my-2">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Nama</label>
                                <input class="form-control" type="text" id="nama" name="nama"
                                    value="{{ request('nama') }}">
                            </div>
                        </div>
                        <div class="col-md-2 ">
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
                        <div class="col-md-2 ">
                            <div class="input-group input-group-outline my-3">
                                <select class="form-control" name="hari" id="hari">
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
                        </div>
                        <div class="col-md-2 ">
                            <div class="input-group input-group-outline my-3">
                                <select class="form-control" name="tahun_id" id="tahun_id">
                                    <option value="" hidden>Pilih Tahun Ajaran</option>
                                    @foreach ($data_tahun as $tahun)
                                        @if (old('tahun_id') == $tahun->id || request('tahun_id') == $tahun->id)
                                            <option value="{{ $tahun->id }}" selected>{{ $tahun->nama }} -
                                                {{ $tahun->semester }}
                                            </option>
                                        @else
                                            <option value="{{ $tahun->id }}">{{ $tahun->nama }} -
                                                {{ $tahun->semester }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-self-end">
                            <button type="submit" class="btn btn-success">Filter</button>
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
                                    <td class="px-4">{{ $loop->iteration }}</td>
                                    <td class="px-4">{{ $jadwal->kelas->nama }}</td>
                                    <td class="px-4 text-wrap">{{ $jadwal->mapel->nama }}</td>
                                    <td class="px-4 text-wrap">{{ $jadwal->user->nama }}</td>
                                    <td class="px-4">{{ $jadwal->tahun_ajaran->nama }}</td>
                                    <td class="px-4">{{ $jadwal->tahun_ajaran->semester }}</td>
                                    <td class="px-4">{{ $jadwal->hari }}</td>
                                    <td class="px-4">{{ $jadwal->jam_mulai }}</td>
                                    <td class="px-4">{{ $jadwal->jam_selesai }}</td>
                                    <td class="px-4">
                                        <a href="/jadwal/{{ $jadwal->id }}">
                                            <span class="badge bg-gradient-success" title="Lihat Detail">
                                                <i class="fas fa-eye "></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $data_jadwal->links() }}
@endsection
