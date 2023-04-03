@extends('layout.main')

@Section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Detail Mata Pelajaran</h6>
                </div>
            </div>
            <div class="table-responsive p-4">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th class="w-15">Nama Mata Pelajaran</th>
                            <td>: {{ $data_mapel->nama }}</td>
                        </tr>
                        <tr>
                            <th class="w-15">Jurusan</th>
                            <td>: @empty($data_mapel->jurusan->nama)
                                    -
                                @else
                                    {{ $data_mapel->jurusan->nama }}
                                @endempty
                            </td>
                        </tr>
                        <tr>
                            <th class="w-15">Keterangan</th>
                            <td>: {{ $data_mapel->keterangan }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ URL::previous() }}" class="btn btn-warning mb-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
