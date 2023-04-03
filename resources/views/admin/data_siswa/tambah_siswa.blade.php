@extends('layout.main')

@section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Tambah Siswa</h6>
                </div>
            </div>
            <form action="/data_siswa" method="POST">
                @csrf
                <div class="row p-3">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="nama">Nama:</label>
                        <input type="text" name="nama"
                            class="form-control border border-2 p-2 @error('nama') is-invalid @enderror" id="nama"
                            value="{{ old('nama') }}" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="nisn">NISN:</label>
                        <input type="text" name="nisn"
                            class="form-control border border-2 p-2 @error('nisn') is-invalid @enderror" id="nisn"
                            value="{{ old('nisn') }}" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="alamat">Alamat:</label>
                        <input type="text" name="alamat"
                            class="form-control border border-2 p-2 @error('alamat') is-invalid @enderror" id="alamat"
                            value="{{ old('alamat') }}" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="no_HP">No.HP:</label>
                        <input type="text" name="no_HP"
                            class="form-control border border-2 p-2 @error('no_HP') is-invalid @enderror" id="no_HP"
                            value="{{ old('no_HP') }}" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="kelas_id">Kelas:</label>
                        <select name="kelas_id"
                            class="form-select border border-2 p-2 @error('kelas_id') is-invalid @enderror" id="kelas_id"
                            aria-label="Default select example" onfocus="focused(this)" onfocusout="defocused(this)">
                            <option value="" selected hidden>Pilih Kelas</option>
                            @foreach ($class as $kelas)
                                @if (old('kelas_id') == $kelas->id)
                                    <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}</option>
                                @else
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
