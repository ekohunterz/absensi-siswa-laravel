@extends('layout.main')

@Section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Data Absensi</h6>
                </div>
            </div>
            <form action="/data_rekap" method="get">
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
                                <select class="form-control" name="tahun_id" id="tahun_id">
                                    <option value="" hidden>Pilih Tahun</option>
                                    @foreach ($data_tahun as $tahun)
                                        @if (old('tahun_id') == $tahun->id || request('tahun_id') == $tahun->id)
                                            <option value="{{ $tahun->id }}" selected>{{ $tahun->nama }} -
                                                {{ $tahun->semester }}
                                            </option>
                                        @else
                                            <option value="{{ $tahun->id }}">{{ $tahun->nama }} -
                                                {{ $tahun->semester }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="input-group input-group-outline my-3">
                                <select class="form-control" name="bulan_id" id="bulan_id">
                                    <option value="" hidden>Pilih Bulan</option>
                                    @foreach ($bulan->pluck('nama', 'id') as $id => $nama)
                                        @if (old('bulan_id') == $id || request('bulan_id') == $id)
                                            <option value="{{ $id }}" selected>{{ $nama }}</option>
                                        @else
                                            <option value="{{ $id }}">{{ $nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-self-end">
                            <button type="submit" class="btn btn-success">Pilih</button>
                            @if ($data->count())
                                <button class="btn btn-warning ms-2" formaction="/guru/data_rekap/export">Export
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
            <div class="card-body px-0 pb-2">
                @if ($data->count())
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Hadir</th>
                                    <th scope="col">Alpha</th>
                                    <th scope="col">Sakit</th>
                                    <th scope="col">Izin</th>
                                    <th scope="col">Total Tidak Hadir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalHadir = 0;
                                    $totalAlpha = 0;
                                    $totalIzin = 0;
                                    $totalSakit = 0;
                                @endphp
                                @foreach ($data as $siswa)
                                    <tr>
                                        <td class="px-4">{{ $loop->iteration }}</td>
                                        <td class="px-4">{{ $siswa->siswa->nama }}</td>
                                        <td class="px-4">{{ $siswa->tHadir }}</td>
                                        <td class="px-4">{{ $siswa->tAlpha }}</td>
                                        <td class="px-4">{{ $siswa->tSakit }}</td>
                                        <td class="px-4">{{ $siswa->tIjin }}</td>
                                        <td class="px-4">{{ $siswa->total }}</td>
                                    </tr>
                                    @php
                                        $totalHadir += $siswa->tHadir;
                                        $totalAlpha += $siswa->tAlpha;
                                        $totalSakit += $siswa->tSakit;
                                        $totalIzin += $siswa->tIjin;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="lead text-center">Silahkan pilih kelas, mapel dan tanggal</p>
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
                            <p class="text-sm mb-0 text-capitalize">Jumlah Hadir</p>
                            <h4 class="mb-0">{{ $totalHadir }} </h4>
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
                            <p class="text-sm mb-0 text-capitalize">Jumlah Sakit</p>
                            <h4 class="mb-0">{{ $totalSakit }}</h4>
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
                            <p class="text-sm mb-0 text-capitalize">Jumlah Izin</p>
                            <h4 class="mb-0">{{ $totalIzin }}</h4>
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
                            <p class="text-sm mb-0 text-capitalize">Jumlah Alpha</p>
                            <h4 class="mb-0">{{ $totalAlpha }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
