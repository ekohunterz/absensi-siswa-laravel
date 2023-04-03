<table>
    <thead>
        <tr>
            <th></th>
            <th colspan="6">Rekap Absensi</th>
        </tr>
        <tr>
            <td></td>
            <td>Mata Pelajaran : {{ $data->first()->mapel }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td>Tahun Ajaran</td>
            <td>: {{ $data->first()->tahun }}</td>
        </tr>
        <tr>
            <td></td>
            <td>Kelas : {{ $data->first()->kelas }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td>Semester</td>
            <td>: {{ $data->first()->semester }}</td>
        </tr>
        <tr>

        </tr>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama Siswa</th>
            <th scope="col">Total Sakit</th>
            <th scope="col">Total Izin</th>
            <th scope="col">Total Hadir</th>
            <th scope="col">Total Alpha</th>
            <th scope="col">Total Tidak Hadir</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->tSakit }}</td>
                <td>{{ $row->tIjin }}</td>
                <td>{{ $row->tHadir }}</td>
                <td>{{ $row->tAlpha }}</td>
                <td>{{ $row->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
