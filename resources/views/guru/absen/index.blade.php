@extends('layout.main')

@Section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Absen</h6>
                </div>
            </div>
            <form action="/guru/absen" method="get">
                <div class="mx-3 my-2">
                    <div class="row align-items-center">
                        <div class="col-md-2 ">
                            <div class="input-group input-group-outline my-3">
                                <select class="form-control" name="jadwal_id" id="jadwal_id">
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
                        </div>
                        <div class="col-md-3 d-flex align-self-end">
                            <button type="submit" class="btn btn-success">Pilih</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <form action="/absen" method="post">
                        @csrf
                        <table class="table align-items-center mb-0 ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">NISN</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $siswa)
                                    <tr>
                                        <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                                        <input type="hidden" name="jadwal_id" value="{{ request('jadwal_id') }}">
                                        <td class="px-4">{{ $loop->iteration }}</td>
                                        <td class="px-4">{{ $siswa->nama }}</td>
                                        <td class="px-4">{{ $siswa->nisn }}</td>
                                        <td class="px-4">
                                            <label>
                                                <input type="radio" name="status[{{ $siswa->id }}]" value="Alpha"
                                                    checked @if (old('status[{{ $siswa->id }}]', $siswa->status) == 'Alpha') checked @endif> Alpha
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
                        <div class="col-auto pt-4 px-4"><button class="btn btn-primary" type="submit" id="submit"
                                hidden>Absen</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (!empty(request('jadwal_id')))
        <script>
            document.getElementById('jadwal_id').value = {{ request('jadwal_id') }};
            document.getElementById('submit').removeAttribute('hidden');
        </script>
    @endif
@endsection
