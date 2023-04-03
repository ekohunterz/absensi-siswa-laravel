@extends('layout.main')

@Section('container')
    <h2>Detail Siswa</h2>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Nama : {{ $data_siswa->nama }}</li>
        <li class="list-group-item">NISN : {{ $data_siswa->nisn }}</li>
        <li class="list-group-item">Alamat : {{ $data_siswa->alamat }}</li>
        <li class="list-group-item">No HP : {{ $data_siswa->no_HP }}</li>
        <li class="list-group-item">Kelas : {{ $data_siswa->kelas->nama }}</li>
    </ul>
@endsection
