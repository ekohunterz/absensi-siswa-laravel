@extends('layout.main')

@section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Edit Mata Pelajaran</h6>
                </div>
            </div>
            <form action="/admin/mapel/{{ $data_mapel->id }}" method="POST">
                @method('put')
                @csrf
                <div class="row p-3">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="nama">Nama:</label>
                        <input type="text" name="nama"
                            class="form-control border border-2 p-2 @error('nama') is-invalid @enderror" id="nama"
                            value="{{ old('nama', $data_mapel->nama) }}" onfocus="focused(this)"
                            onfocusout="defocused(this)">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="alamat">Keterangan:</label>
                        <input type="text" name="keterangan"
                            class="form-control border border-2 p-2 @error('keterangan') is-invalid @enderror"
                            id="keterangan" value="{{ old('nama', $data_mapel->keterangan) }}" onfocus="focused(this)"
                            onfocusout="defocused(this)">
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="kode">Jurusan:</label>
                        <select name="jurusan_id"
                            class="form-select border border-2 p-2 @error('jurusan_id') is-invalid @enderror"
                            id="jurusan_id" aria-label="Default select example"
                            @empty($data_mapel->jurusan_id) disabled @endempty>
                            <option value="" selected hidden>Semua Jurusan</option>
                            @foreach ($data_jurusan as $jurusan)
                                @if (old('jurusan_id') == $jurusan->id || $data_mapel->jurusan_id == $jurusan->id)
                                    <option value="{{ $jurusan->id }}" selected>{{ $jurusan->nama }}</option>
                                @else
                                    <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="form-check p-0">
                            <input class="form-check-input" type="checkbox" value="" id="mapel_umum"
                                {{ empty($data_mapel->jurusan_id) ? 'checked' : '' }} onchange="toggleJurusan()">
                            <label class="form-check-label" for="mapel_umum">
                                Semua Jurusan
                            </label>
                        </div>
                        @error('jurusan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function toggleJurusan() {
            var checkBox = document.getElementById("mapel_umum");
            var jurusanSelect = document.getElementById("jurusan_id");

            if (checkBox.checked == true) {
                jurusanSelect.selectedIndex = 0;
                jurusanSelect.options[0].text = "Semua Jurusan";
                jurusanSelect.disabled = true;
            } else {
                jurusanSelect.options[0].text = "Pilih Jurusan";
                jurusanSelect.disabled = false;
            }
        }
    </script>
@endsection
