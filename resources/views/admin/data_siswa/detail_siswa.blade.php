@extends('layout.main')

@Section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Detail Siswa</h6>
                </div>
            </div>
            <div class="table-responsive p-4">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th class="w-15">Nama</th>
                            <td>: {{ $data_siswa->nama }}</td>
                        </tr>
                        <tr>
                            <th class="w-15">NISN</th>
                            <td>: {{ $data_siswa->nisn }}</td>
                        </tr>
                        <tr>
                            <th class="w-15">Alamat</th>
                            <td>: {{ $data_siswa->alamat }}</td>
                        </tr>
                        <tr>
                            <th class="w-15">No. HP</th>
                            <td>: {{ $data_siswa->no_HP }}</td>
                        </tr>
                        <tr>
                            <th class="w-15">No. HP Orangtua</th>
                            <td>: {{ $data_siswa->no_HP_ortu }}</td>
                        </tr>
                        <tr>
                            <th class="w-15">Kelas</th>
                            <td>: {{ $data_siswa->kelas->nama }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ URL::previous() }}" class="btn btn-warning mb-3">Kembali</a>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Kehadiran Siswa</h6>
                </div>
            </div>
            <div class="p-4" id="calendar"></div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: {!! json_encode($events) !!}
            });
            calendar.render();
        });
    </script>
@endsection
