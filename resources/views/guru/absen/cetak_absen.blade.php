<table>
    <thead>
        <tr>
            <th></th>
            <th colspan="4">Rekap Absensi</th>
        </tr>
        <tr>
            <td></td>
            <td>Mata Pelajaran : {{ $data->first()->jadwal->mapel->nama }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>Kelas : {{ $data->first()->siswa->kelas->nama }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>

        </tr>
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
                <td>{{ $loop->iteration }}</td>
                <td>{{ $siswa->siswa->nama }}</td>
                <td>{{ $siswa->siswa->nisn }}</td>
                <td>{{ $siswa->tanggal }}</td>
                <td>{{ $siswa->status }}</td>
            </tr>
        @endforeach
        <tr></tr>
        <tr>
            <th></th>
            <th></th>
            <th>Hadir</th>
            <th>{{ $data->where('status', '=', 'Hadir')->count() }}</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th>Sakit</th>
            <th>{{ $data->where('status', '=', 'Sakit')->count() }}</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th>Izin</th>
            <th>{{ $data->where('status', '=', 'Izin')->count() }}</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th>Alpha</th>
            <th>{{ $data->where('status', '=', 'Alpha')->count() }}</th>
        </tr>

    </tbody>
</table>
