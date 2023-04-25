@extends('layout.main')

@Section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Data Absensi</h6>
                </div>
            </div>
            <form method="GET" action="/data_absen">
                <div class="mx-3 my-2">
                    <div class="row align-items-center">
                        <div class="col-md-2 ">
                            <div class="input-group input-group-outline my-3">
                                <select class="form-control" name="kelas_id" id="kelas_id">
                                    <option value="" hidden>Pilih Kelas</option>
                                    @foreach ($class as $kelas)
                                        @if (old('kelas_id') == $kelas->id || request('kelas_id') == $kelas->id)
                                            <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}</option>
                                        @else
                                            <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="input-group input-group-outline my-3">
                                <select class="form-control" name="mapel_id" id="mapel_id">
                                    <option value="" hidden>Pilih Mapel</option>
                                    @foreach ($data_mapel as $mapel)
                                        @if (old('mapel_id') == $mapel->id || request('mapel_id') == $mapel->id)
                                            <option value="{{ $mapel->id }}" selected>{{ $mapel->nama }}</option>
                                        @else
                                            <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="input-group input-group-outline my-3">
                                <input class="form-control" type="date" id="tanggal" name="tanggal"
                                    value="{{ request('tanggal') }}">
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-self-end">
                            <button type="submit" class="btn btn-success">Pilih</button>
                            <a href="/data_absen" class="btn btn-danger ms-2">Reset</a>
                            @if ($data->count())
                                <button class="btn btn-warning ms-2" formaction="/guru/data_absen/export">Export
                                </button>
                            @endif
                        </div>
                        <div class="col-md-3 text-end  align-self-end">
                            <a href="/admin/absen" type="button" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card-body px-0 pb-2">
                @if ($jadwal && $data->count())
                    <div class="table-responsive p-0">
                        <form action="/data_absen/update" method="post">
                            @csrf
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Siswa</th>
                                        <th scope="col">NISN</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $siswa)
                                        <tr>
                                            <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                                            <input type="hidden" name="jadwal_id" value="{{ $siswa->jadwal_id }}">
                                            <input type="hidden" name="tanggal" value="{{ request('tanggal') }}">
                                            <td class="px-4">{{ $loop->iteration }}</td>
                                            <td class="px-4">{{ $siswa->siswa->nama }}</td>
                                            <td class="px-4">{{ $siswa->siswa->nisn }}</td>
                                            <td class="px-4">{{ $siswa->tanggal }}</td>
                                            <td class="px-4">
                                                <select class="form-select px-2" name="status[]" id="status[]" disabled>
                                                    <option value="Alpha"
                                                        @if (old('status[]', $siswa->status) == 'Alpha') selected @endif>
                                                        Alpha
                                                    </option>
                                                    <option value="Hadir"
                                                        @if (old('status[]', $siswa->status) == 'Hadir') selected @endif>
                                                        Hadir
                                                    </option>
                                                    <option value="Izin"
                                                        @if (old('status[]', $siswa->status) == 'Izin') selected @endif>
                                                        Izin
                                                    </option>
                                                    <option value="Sakit"
                                                        @if (old('status[]', $siswa->status) == 'Sakit') selected @endif>
                                                        Sakit
                                                    </option>
                                                </select>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-md-6 px-3">
                                <button type="submit" class="btn btn-primary" id="submit" hidden>Simpan</button>
                                <a class="btn btn-primary" id="edit">Edit</a>
                                <a class="btn btn-primary" id="batal" hidden>Batal</a>
                            </div>
                        </form>
                    </div>
                @elseif ($jadwal && !$data->count())
                    <p class="lead text-center">Guru tidak melakukan absen</p>
                @elseif (!request('tanggal'))
                    <p class="lead text-center">Pilih kelas, mapel dan tanggal</p>
                @elseif (!$jadwal)
                    <p class="lead text-center">Tidak ada jadwal pada hari yang dipilih</p>
                @endif

            </div>
        </div>
    </div>
    @if ($data->count())
        <div class="row mt-4">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">check_box</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Hadir</p>
                            <h4 class="mb-0">{{ $data->where('status', '=', 'Hadir')->count() }} Siswa</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">medication</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Sakit</p>
                            <h4 class="mb-0">{{ $data->where('status', '=', 'Sakit')->count() }} Siswa</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">comment</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Izin</p>
                            <h4 class="mb-0">{{ $data->where('status', '=', 'Izin')->count() }} Siswa</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">cancel</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Alpha</p>
                            <h4 class="mb-0">{{ $data->where('status', '=', 'Alpha')->count() }} Siswa</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (!empty(request('kelas_id')))
        <script>
            document.getElementById('kelas_id').value = {{ request('kelas_id') }};
            document.getElementById('mapel_id').value = {{ request('mapel_id') }};

            document.getElementById("edit").addEventListener("click", function() {
                document.querySelector("#submit").removeAttribute("hidden");
                document.querySelector("#batal").removeAttribute("hidden");
                document.querySelector("#edit").setAttribute("hidden", "");
                document.querySelectorAll('select').forEach(select => {
                    select.removeAttribute('disabled');
                });
            });

            document.getElementById("batal").addEventListener("click", function() {
                location.reload();
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#kelas_id').on('change', function() {
                var kelas_id = $(this).val();
                if (kelas_id) {
                    $.ajax({
                        url: '/mapel/' + kelas_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#mapel_id').empty();
                            $('#mapel_id').append(
                                '<option value="" hidden>Pilih Mapel</option>');
                            $.each(data, function(key, value) {
                                $('#mapel_id').append('<option value="' + value.id +
                                    '">' + value.nama + '</option>');
                            });
                        }
                    });
                } else {
                    $('#mapel_id').empty();
                    $('#mapel_id').append('<option value="" hidden>Pilih Mapel</option>');
                }
            });
        });
    </script>
@endsection
