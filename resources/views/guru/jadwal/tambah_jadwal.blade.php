@extends('layout.main')

@Section('container')
    <h2>Tambah Mata Pelajaran</h2>
    <form action="/admin/jadwal" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Kelas</label>
            <select name="kelas_id" class="form-select @error('kelas_id') is-invalid @enderror" id="kelas_id"
                aria-label="Default select example">
                <option value="" selected hidden>Pilih kelas</option>
                @foreach ($data_kelas as $kelas)
                    @if (old('kelas_id') == $kelas->id)
                        <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}</option>
                    @else
                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Mata Pelajaran</label>
            <select name="mapel_id" class="form-select @error('mapel_id') is-invalid @enderror" id="mapel_id"
                aria-label="Default select example">
                <option value="" selected hidden>Pilih Mapel</option>
                @foreach ($data_mapel as $mapel)
                    @if (old('mapel_id') == $mapel->id)
                        <option value="{{ $mapel->id }}" selected>{{ $mapel->nama }}</option>
                    @else
                        <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Guru</label>
            <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" id="user_id"
                aria-label="Default select example">
                <option value="" selected hidden>Pilih Guru</option>
                @foreach ($data_user as $user)
                    @if (old('user_id') == $user->id)
                        <option value="{{ $user->id }}" selected>{{ $user->nama }}</option>
                    @else
                        <option value="{{ $user->id }}">{{ $user->nama }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Tahun Ajaran</label>
            <select name="tahun_ajaran_id" class="form-select @error('tahun_ajaran_id') is-invalid @enderror"
                id="tahun_ajaran_id" aria-label="Default select example">
                <option value="" selected hidden>Pilih Tahun Ajaran</option>
                @foreach ($data_tahun as $tahun_ajaran)
                    @if (old('tahun_ajaran_id') == $tahun_ajaran->id)
                        <option value="{{ $tahun_ajaran->id }}" selected>{{ $tahun_ajaran->nama }} -
                            {{ $tahun_ajaran->semester }}</option>
                    @else
                        <option value="{{ $tahun_ajaran->id }}">{{ $tahun_ajaran->nama }} - {{ $tahun_ajaran->semester }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Hari</label>
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
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror"
                id="jam_mulai" placeholder="jam_mulai" value="{{ old('jam_mulai') }}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror"
                id="jam_selesai" placeholder="jam_selesai" value="{{ old('jam_selesai') }}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
            <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                id="keterangan" placeholder="keterangan" value="{{ old('keterangan') }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Tambah</button>
        </div>
    </form>
@endsection
