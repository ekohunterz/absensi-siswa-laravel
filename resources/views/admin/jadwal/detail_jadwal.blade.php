@extends('layout.main')

@Section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Detail Jadwal</h6>
                </div>
            </div>
            <div class="table-responsive p-4">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th class="w-25">Kelas</th>
                            <td>: {{ $data_jadwal->kelas->nama }}</td>
                        </tr>
                        <tr>
                            <th class="w-25">Mata Pelajaran</th>
                            <td>: {{ $data_jadwal->mapel->nama }}</td>
                        </tr>
                        <tr>
                            <th class="w-25">Guru</th>
                            <td>: {{ $data_jadwal->user->nama }}</td>
                        </tr>
                        <tr>
                            <th class="w-25">Tahun Ajaran</th>
                            <td>: {{ $data_jadwal->tahun_ajaran->nama }}</td>
                        </tr>
                        <tr>
                            <th class="w-25">Semester</th>
                            <td>: {{ $data_jadwal->tahun_ajaran->semester }}</td>
                        </tr>
                        <tr>
                            <th class="w-25">Hari</th>
                            <td>: {{ $data_jadwal->hari }}</td>
                        </tr>
                        <tr>
                            <th class="w-25">Jam Mulai</th>
                            <td>: {{ $data_jadwal->jam_mulai }}</td>
                        </tr>
                        <tr>
                            <th class="w-25">Jam Selesai</th>
                            <td>: {{ $data_jadwal->jam_selesai }}</td>
                        </tr>
                        <tr>
                            <th class="w-25">Keterangan</th>
                            <td>: {{ $data_jadwal->keterangan }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ URL::previous() }}" class="btn btn-warning mb-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
