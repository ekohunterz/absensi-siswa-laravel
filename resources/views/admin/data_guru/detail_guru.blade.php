@extends('layout.main')

@Section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Detail Guru</h6>
                </div>
            </div>
            <div class="table-responsive p-4">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th class="w-15">Nama</th>
                            <td>: {{ $data_guru->nama }}</td>
                        </tr>
                        <tr>
                            <th class="w-15">NIP</th>
                            <td>: {{ $data_guru->nip }}</td>
                        </tr>
                        <tr>
                            <th class="w-15">Alamat</th>
                            <td>: {{ $data_guru->alamat }}</td>
                        </tr>
                        <tr>
                            <th class="w-15">Tanggal Lahir</th>
                            <td>: {{ $data_guru->tgl_lahir }}</td>
                        </tr>
                        <tr>
                            <th class="w-15">No HP</th>
                            <td>: {{ $data_guru->no_HP }}</td>
                        </tr>
                        <tr>
                            <th class="w-15">Email</th>
                            <td>: {{ $data_guru->email }}</td>
                        </tr>
                        <tr>
                            <th class="w-15">Status</th>
                            <td>: {{ $data_guru->status }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ URL::previous() }}" class="btn btn-warning mb-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
