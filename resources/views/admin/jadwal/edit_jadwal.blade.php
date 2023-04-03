@extends('layout.main')

@section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Edit Jadwal</h6>
                </div>
            </div>
            <form action="/jadwal/{{ $data_jadwal->id }}" method="POST">
                @method('put')
                @csrf
                <div class="row p-3">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="kelas_id">Kelas:</label>
                        <select name="kelas_id"
                            class="form-select border border-2 p-2 @error('kelas_id') is-invalid @enderror" id="kelas_id"
                            aria-label="Default select example...">
                            <option value="" selected hidden>Pilih Kelas</option>
                            @foreach ($data_kelas as $kelas)
                                @if (old('kelas_id', $data_jadwal->kelas_id) === $kelas->id)
                                    <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}</option>
                                @else
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="mapel_id">Mapel:</label>
                        <select name="mapel_id"
                            class="form-select border border-2 p-2 @error('mapel_id') is-invalid @enderror" id="mapel_id"
                            aria-label="Default select example...">
                            <option value="" selected hidden>Pilih Mata Pelajaran</option>
                            @foreach ($data_mapel as $mapel)
                                @if (old('mapel_id', $data_jadwal->mapel->id) == $mapel->id)
                                    <option value="{{ $mapel->id }}" selected>{{ $mapel->nama }}</option>
                                @else
                                    <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="user_id">Guru:</label>
                        <select name="user_id"
                            class="form-select border border-2 p-2 @error('user_id') is-invalid @enderror" id="user_id"
                            aria-label="Default select example...">
                            <option value="" selected hidden>Pilih Guru</option>
                            @foreach ($data_user as $user)
                                @if (old('user_id', $data_jadwal->user->id) == $user->id)
                                    <option value="{{ $user->id }}" selected>{{ $user->nama }}</option>
                                @else
                                    <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="tahun_ajaran_id">Tahun Ajaran:</label>
                        <select name="tahun_ajaran_id"
                            class="form-select border border-2 p-2 @error('tahun_ajaran_id') is-invalid @enderror"
                            id="tahun_ajaran_id" aria-label="Default select example...">
                            <option value="" selected hidden>Pilih Tahun Ajaran</option>
                            @foreach ($data_tahun as $tahun_ajaran)
                                @if (old('tahun_ajaran_id', $data_jadwal->tahun_ajaran->id) == $tahun_ajaran->id)
                                    <option value="{{ $tahun_ajaran->id }}" selected>{{ $tahun_ajaran->nama }} -
                                        {{ $tahun_ajaran->semester }}</option>
                                @else
                                    <option value="{{ $tahun_ajaran->id }}">{{ $tahun_ajaran->nama }} -
                                        {{ $tahun_ajaran->semester }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="jam_mulai">Jam Mulai:</label>
                        <input type="time" name="jam_mulai"
                            class="form-control border border-2 p-2 @error('jam_mulai') is-invalid @enderror" id="jam_mulai"
                            value="{{ old('jam_mulai', $data_jadwal->jam_mulai) }}" onfocus="focused(this)"
                            onfocusout="defocused(this)">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="jam_selesai">Jam Selesai:</label>
                        <input type="time" name="jam_selesai"
                            class="form-control border border-2 p-2 @error('jam_selesai') is-invalid @enderror"
                            id="jam_selesai" value="{{ old('jam_selesai', $data_jadwal->jam_selesai) }}"
                            onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="hari">Hari:</label>
                        <select name="hari" class="form-select border border-2 p-2 @error('hari') is-invalid @enderror"
                            id="hari" aria-label="Default select example...">
                            <option value="" selected hidden>Pilih Hari</option>
                            @foreach ($hari->pluck('nama', 'id') as $id => $nama)
                                @if (old('hari', $data_jadwal->hari) == $id || request('hari') == $id)
                                    <option value="{{ $id }}" selected>{{ $nama }}</option>
                                @else
                                    <option value="{{ $id }}">{{ $nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="keterangan">Keterangan:</label>
                        <input type="text" name="keterangan"
                            class="form-control border border-2 p-2 @error('keterangan') is-invalid @enderror"
                            id="keterangan" value="{{ old('keterangan', $data_jadwal->keterangan) }}"
                            onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
