@extends('layout.main')

@Section('container')
    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Siswa</p>
                        <h4 class="mb-0">{{ $siswa }} Siswa</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <a href="/data_siswa" class="mb-0">Lihat selengkapnya...</a>
                </div>
            </div>
        </div>
        @can('admin')
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Guru</p>
                            <h4 class="mb-0">{{ $guru }} Guru</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <a href="/admin/data_guru" class="mb-0">Lihat selengkapnya...</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">home</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Kelas</p>
                            <h4 class="mb-0">{{ $kelas }} Kelas</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <a href="/admin/kelas" class="mb-0">Lihat selengkapnya...</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">weekend</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Data Jurusan</p>
                            <h4 class="mb-0">{{ $jurusan }} Jurusan</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <a href="/admin/jurusan" class="mb-0">Lihat selengkapnya...</a>
                    </div>
                </div>
            </div>
        @else
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">access_alarm</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Jadwal Sekarang</p>
                            <h4 class="mb-0"> -
                                @if ($jadwal !== null)
                                    {{ $jadwal->mapel->nama }}
                                @endif
                            </h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text font-weight-bolder"> -
                                @if ($jadwal !== null)
                                    {{ $jadwal->jam_mulai }} -
                                    {{ $jadwal->jam_selesai }}
                                @endif
                            </span></p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">local_library</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Jumlah Mengajar</p>
                            <h4 class="mb-0">{{ $jumlah_ngajar }} Kelas</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <a href="/jadwal" class="mb-0">Lihat selengkapnya...</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-secondary shadow-secondary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">access_time</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize" id="date"></p>
                            <h4 class="mb-0" id="clock"></h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0">Tahun Ajaran {{ $tahun_ajaran->nama }} -
                            {{ $tahun_ajaran->semester }}</p>
                    </div>
                </div>
            </div>
        @endcan
    </div>

    <div class="row mb-4">
        <div class="col-lg-7 col-md-5 mb-md-0 mb-5">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Jadwal Hari Ini</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-clock text-info" aria-hidden="true"></i>
                                <span
                                    class="font-weight-bold ms-1">{{ Carbon\Carbon::now()->translatedFormat('l') }},</span>
                                {{ Carbon\Carbon::now()->format('d F Y') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Kelas
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Mata Pelajaran
                                    </th>
                                    @can('admin')
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Guru
                                        </th>
                                    @endcan
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jam Mulai
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jam Selesai</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Keterangan Absen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal_all as $jdwl)
                                    <tr>
                                        <td class="align-middle text-sm ">
                                            <h6 class="mb-0 text-sm mx-3">{{ $jdwl->kelas->nama }}</h6>
                                        </td>
                                        <td class="align-middle text-sm ">
                                            <h6 class="mb-0 text-sm mx-3">{{ $jdwl->mapel->nama }}</h6>
                                        </td>
                                        @can('admin')
                                            <td class="align-middle text-sm text-wrap">
                                                <h6 class="mb-0 text-sm mx-3">{{ $jdwl->user->nama }}</h6>
                                            </td>
                                        @endcan
                                        <td class="align-middle text-sm ">
                                            <span class="text-xs font-weight-bold mx-3"> {{ $jdwl->jam_mulai }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold mx-3"> {{ $jdwl->jam_selesai }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            @if ($absensi[$jdwl->id])
                                                <span class="badge bg-success mx-3">Sudah Absen</span>
                                            @else
                                                <span class="badge bg-danger mx-3">Belum Absen</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-4 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Siswa Tidak Hadir Hari Ini</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-clock text-info" aria-hidden="true"></i>
                                <span
                                    class="font-weight-bold ms-1">{{ Carbon\Carbon::now()->translatedFormat('l') }},</span>
                                {{ Carbon\Carbon::now()->format('d F Y') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Kelas
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Mapel
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tidak_hadir as $absen)
                                    <tr>
                                        <td class="align-middle text-sm text-wrap">
                                            <h6 class="mb-0 text-sm mx-3">{{ $absen->siswa->nama }}</h6>
                                        </td>
                                        <td class="align-middle text-sm ">
                                            <h6 class="mb-0 text-sm mx-3">{{ $absen->siswa->kelas->nama }}</h6>
                                        </td>
                                        <td class="align-middle text-sm ">
                                            <span class="text-xs font-weight-bold mx-3"> {{ $absen->jadwal->mapel->nama }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span class="text-xs font-weight-bold mx-3"> {{ $absen->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mx-3 mt-2">{{ $tidak_hadir->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function displayTime() {
        var currentTime = new Date();
        var date = currentTime.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var seconds = currentTime.getSeconds();

        // tambahkan angka 0 di depan bilangan < 10
        hours = (hours < 10 ? "0" : "") + hours;
        minutes = (minutes < 10 ? "0" : "") + minutes;
        seconds = (seconds < 10 ? "0" : "") + seconds;

        // tampilkan waktu dalam format hh:mm:ss
        var timeString = hours + ":" + minutes + ":" + seconds;

        // tampilkan waktu di dalam span dengan id "clock"
        document.getElementById("date").innerHTML = date;
        document.getElementById("clock").innerHTML = timeString;

    }

    // panggil fungsi displayTime() setiap 1 detik
    setInterval(displayTime, 1000);
</script>
