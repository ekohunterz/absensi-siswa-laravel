@extends('layout.main')

@section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Edit Tahun Ajaran</h6>
                </div>
            </div>
            <form action="/admin/tahun_ajaran/{{ $data_tahun->id }}" method="POST">
                @method('put')
                @csrf
                <div class="row p-3">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="nama">Nama:</label>
                        <input type="text" name="nama"
                            class="form-control border border-2 p-2 @error('nama') is-invalid @enderror" id="nama"
                            value="{{ old('nama', $data_tahun->nama) }}" onfocus="focused(this)"
                            onfocusout="defocused(this)">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="keterangan">Keterangan:</label>
                        <input type="text" name="keterangan"
                            class="form-control border border-2 p-2 @error('keterangan') is-invalid @enderror"
                            id="keterangan" value="{{ old('keterangan', $data_tahun->keterangan) }}" onfocus="focused(this)"
                            onfocusout="defocused(this)">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="exampleFormControlTextarea1" class="form-label">Semester</label>
                        <div class="form-check">
                            <input class="form-check-input @error('semester') is-invalid @enderror" type="radio"
                                name="semester" id="semester" value="Ganjil"
                                @if (old('semester', $data_tahun->semester) == 'Ganjil') checked @endif>
                            <label class="form-check-label" for="semesterGanjil">
                                Ganjil
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input @error('semester') is-invalid @enderror" type="radio"
                                name="semester" id="semester" value="Genap"
                                @if (old('semester', $data_tahun->semester) == 'Genap') checked @endif>
                            <label class="form-check-label" for="semesterGenap">
                                Genap
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="exampleFormControlTextarea1" class="form-label">Status</label>
                        <div class="form-check">
                            <input class="form-check-input @error('is_active') is-invalid @enderror" type="radio"
                                name="is_active" id="is_active" value="1"
                                @if (old('is_active', $data_tahun->is_active) == '1') checked @endif>
                            <label class="form-check-label" for="is_active">
                                Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input @error('is_active') is-invalid @enderror" type="radio"
                                name="is_active" id="is_active" value="0"
                                @if (old('is_active', $data_tahun->is_active) == '0') checked @endif>
                            <label class="form-check-label" for="is_active">
                                Tidak Aktif
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <button type="submit" class="btn btn-primary mb-3">Update</button>
                        <a href="{{ URL::previous() }}" class="btn btn-warning mb-3">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
