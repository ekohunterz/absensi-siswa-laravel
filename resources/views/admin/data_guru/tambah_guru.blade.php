@extends('layout.main')

@section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Tambah Guru</h6>
                </div>
            </div>
            <form action="/admin/data_guru" method="POST">
                @csrf
                <div class="row p-3">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="nama">Nama:</label>
                        <input type="text" name="nama"
                            class="form-control border border-2 p-2 @error('nama') is-invalid @enderror" id="nama"
                            value="{{ old('nama') }}" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="nip">NIP:</label>
                        <input type="text" name="nip"
                            class="form-control border border-2 p-2 @error('nip') is-invalid @enderror" id="nip"
                            value="{{ old('nip') }}" onfocus="focused(this)" onfocusout="defocused(this)">
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
                        <label class="form-label" for="email">Email:</label>
                        <input type="text" name="email"
                            class="form-control border border-2 p-2 @error('email') is-invalid @enderror" id="email"
                            value="{{ old('email') }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="exampleFormControlTextarea1" class="form-label">Status</label>
                        <div class="form-check">
                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio"
                                name="status" id="status" value="PNS" checked>
                            <label class="form-check-label" for="status">
                                PNS
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio"
                                name="status" id="status" value="Honorer">
                            <label class="form-check-label" for="status">
                                Honorer
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <button type="submit" class="btn btn-primary mb-3">Tambah</button>
                        <a href="{{ URL::previous() }}" class="btn btn-warning mb-3">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
