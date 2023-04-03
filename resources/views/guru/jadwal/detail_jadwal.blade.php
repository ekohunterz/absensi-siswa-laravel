@extends('layout.main')

@Section('container')
    <h2>Detail Jadwal Pelajaran</h2>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Kelas : {{ $data_jadwal->kelas->nama }}</li>
        <li class="list-group-item">Nama Mata Pelajaran : {{ $data_jadwal->mapel->nama }}</li>
        <li class="list-group-item">Guru : {{ $data_jadwal->user->nama }}</li>
        <li class="list-group-item">Tahun Ajaran : {{ $data_jadwal->tahun_ajaran->nama }}</li>
        <li class="list-group-item">Semester : {{ $data_jadwal->tahun_ajaran->semester }}</li>
        <li class="list-group-item">Hari : {{ $data_jadwal->hari }}</li>
        <li class="list-group-item">Jam Mulai : {{ $data_jadwal->jam_mulai }}</li>
        <li class="list-group-item">Jam Selesai : {{ $data_jadwal->jam_selesai }}</li>
        <li class="list-group-item">Keterangan : {{ $data_jadwal->keterangan }}</li>
    </ul>
@endsection
