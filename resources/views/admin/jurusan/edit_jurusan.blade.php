@extends('layout.main')

@section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Edit Jurusan</h6>
                </div>
            </div>
            <form action="/admin/jurusan/{{ $data_jurusan->id }}" method="POST">
                @method('put')
                @csrf
                <div class="row p-3">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="nama">Nama:</label>
                        <input type="text" name="nama"
                            class="form-control border border-2 p-2 @error('nama') is-invalid @enderror" id="nama"
                            value="{{ old('nama', $data_jurusan->nama) }}" onfocus="focused(this)"
                            onfocusout="defocused(this)">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="kode">Kode Jurusan:</label>
                        <input type="text" name="kode"
                            class="form-control border border-2 p-2 @error('kode') is-invalid @enderror" id="kode"
                            value="{{ old('nama', $data_jurusan->nama) }}" onfocus="focused(this)"
                            onfocusout="defocused(this)">
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="alamat">Keterangan:</label>
                        <input type="text" name="keterangan"
                            class="form-control border border-2 p-2 @error('keterangan') is-invalid @enderror"
                            id="keterangan" value="{{ old('nama', $data_jurusan->keterangan) }}" onfocus="focused(this)"
                            onfocusout="defocused(this)">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
