@extends('layout.main')

@section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Edit Guru</h6>
                </div>
            </div>
            <form action="/profile/update" method="POST" enctype="multipart/form-data">
                @method('post')
                @csrf
                <div class="row p-3">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="nama">Nama:</label>
                        <input type="text" name="nama"
                            class="form-control border border-2 p-2 @error('nama') is-invalid @enderror" id="nama"
                            value="{{ old('nama', $data_guru->nama) }}" onfocus="focused(this)"
                            onfocusout="defocused(this)">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="nip">NIP:</label>
                        <input type="text" name="nip"
                            class="form-control border border-2 p-2 @error('nip') is-invalid @enderror" id="nip"
                            value="{{ old('nip', $data_guru->nip) }}" onfocus="focused(this)" onfocusout="defocused(this)"
                            disabled>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="alamat">Alamat:</label>
                        <input type="text" name="alamat"
                            class="form-control border border-2 p-2 @error('alamat') is-invalid @enderror" id="alamat"
                            value="{{ old('alamat', $data_guru->alamat) }}" onfocus="focused(this)"
                            onfocusout="defocused(this)">
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="no_HP">No.HP:</label>
                        <input type="text" name="no_HP"
                            class="form-control border border-2 p-2 @error('no_HP') is-invalid @enderror" id="no_HP"
                            value="{{ old('no_HP', $data_guru->no_HP) }}" onfocus="focused(this)"
                            onfocusout="defocused(this)">
                        @error('no_HP')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="email">Email:</label>
                        <input type="text" name="email"
                            class="form-control border border-2 p-2 @error('email') is-invalid @enderror" id="email"
                            value="{{ old('email', $data_guru->email) }}" onfocus="focused(this)"
                            onfocusout="defocused(this)">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="tgl_lahir">Tanggal Lahir:</label>
                        <input type="text" name="tgl_lahir"
                            class="form-control border border-2 p-2 @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir"
                            value="{{ old('tgl_lahir') }}" onfocus="focused(this)" onfocusout="defocused(this)">
                        @error('tgl_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="foto">Foto:</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <div class="col-auto">
                                        @if (Auth()->user()->foto)
                                            <img class="img-preview mx-auto d-block border-radius-lg shadow-sm"
                                                src="{{ asset('storage/foto-profil/' . auth()->user()->foto) }}"
                                                style="object-fit: cover;object-position: center;" width="150px"
                                                height="150px">
                                        @else
                                            <img class="img-preview mx-auto d-block border-radius-lg shadow-sm"
                                                src="/assets/img/team-2.jpg" style="object-fit: contain;" width="150px"
                                                height="150px">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <input type="file" name="foto"
                                        class="form-control border border-2 p-2 form-control-lg @error('foto') is-invalid @enderror"
                                        id="foto" onchange="previewImage()">
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <button type="submit" class="btn btn-primary mb-3">Update</button>
                        <a href="{{ URL::previous() }}" class="btn btn-warning mb-3">Kembali</a>
                    </div>
                </div>

        </div>
    </div>
    </form>
    </div>
    </div>
    <script>
        function previewImage() {
            const image = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
