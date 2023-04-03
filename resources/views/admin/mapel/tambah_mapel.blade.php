@extends('layout.main')

@section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Tambah Mata Pelajaran</h6>
                </div>
            </div>
            <form action="/admin/mapel" method="POST">
                @csrf
                <div class="row p-3">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="nama">Nama:</label>
                        <input type="text" name="nama"
                            class="form-control border border-2 p-2 @error('nama') is-invalid @enderror" id="nama"
                            value="{{ old('nama') }}" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="alamat">Keterangan:</label>
                        <input type="text" name="keterangan"
                            class="form-control border border-2 p-2 @error('keterangan') is-invalid @enderror"
                            id="keterangan" value="{{ old('nama') }}" onfocus="focused(this)"
                            onfocusout="defocused(this)">
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="kode">Jurusan:</label>
                        <select name="jurusan_id"
                            class="form-select border border-2 p-2 @error('jurusan_id') is-invalid @enderror"
                            id="jurusan_id" aria-label="Default select example">
                            <option value="" selected hidden>Semua Jurusan</option>
                            @foreach ($data_jurusan as $jurusan)
                                @if (old('jurusan_id') == $jurusan->id)
                                    <option value="{{ $jurusan->id }}" selected>{{ $jurusan->nama }}</option>
                                @else
                                    <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="form-check p-0">
                            <input class="form-check-input" type="checkbox" value="" id="mapel_umum"
                                onchange="document.getElementById('jurusan_id').selectedIndex = 0; this.checked;">
                            <label class="form-check-label" for="mapel_umum">
                                Semua Jurusan
                            </label>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
