@extends('layout.main')

@Section('container')
    <h2>Data Siswa</h2>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <form action="/guru/absen" method="get">
        <div class="row mt-4">
            <div class="col-2 sm-3">
                <select class="form-control form-control-sm" name="jadwal_id" id="jadwal_id">
                    <option value="" hidden>Pilih Kelas</option>
                    @foreach ($class as $kelas)
                        @if (old('jadwal_id') == $kelas->id)
                            <option value="{{ $kelas->id_jadwal }}" selected>{{ $kelas->nama }}</option>
                        @else
                            <option value="{{ $kelas->id_jadwal }}">{{ $kelas->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-2 sm-3">
                <button class="btn btn-primary btn-sm" type="submit">Pilih</button>
            </div>
        </div>
    </form>

    <div class="table-responsive mt-3">
        <form action="/absen" method="post">
            @csrf
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $siswa)
                        <tr>
                            <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                            <input type="hidden" name="jadwal_id" value="{{ request('jadwal_id') }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->nisn }}</td>
                            <td>{{ $siswa->alamat }}</td>
                            <td>
                                <label>
                                    <input type="radio" name="status[{{ $siswa->id }}]" value="Alpha" checked
                                        @if (old('status[{{ $siswa->id }}]', $siswa->status) == 'Alpha') checked @endif> Alpha
                                </label>
                                <label>
                                    <input type="radio" name="status[{{ $siswa->id }}]" value="Hadir"
                                        @if (old('status[{{ $siswa->id }}]', $siswa->status) == 'Hadir') checked @endif> Hadir
                                </label>
                                <label>
                                    <input type="radio" name="status[{{ $siswa->id }}]" value="Izin"
                                        @if (old('status[{{ $siswa->id }}]', $siswa->status) == 'Izin') checked @endif> Izin
                                </label>
                                <label>
                                    <input type="radio" name="status[{{ $siswa->id }}]" value="Sakit"
                                        @if (old('status[{{ $siswa->id }}]', $siswa->status) == 'Sakit') checked @endif> Sakit
                                </label>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button class="btn btn-primary btn-sm" type="submit" id="submit" hidden>Absen</button>
        </form>
    </div>
    @if (!empty(request('jadwal_id')))
        <script>
            document.getElementById('jadwal_id').value = {{ request('jadwal_id') }};
            document.getElementById('submit').removeAttribute('hidden');
        </script>
    @endif
@endsection
