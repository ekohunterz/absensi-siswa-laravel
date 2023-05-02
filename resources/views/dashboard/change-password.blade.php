@extends('layout.main')

@section('container')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Ubah Password</h6>
                </div>
            </div>
            <form action="/ubah_pass" method="POST" enctype="multipart/form-data">
                @method('post')
                @csrf
                <div class="row p-3">
                    <div class="mb-3 col-md-7">
                        <label class="form-label" for="old_password">Password Lama:</label>
                        <input id="old_password" type="password"
                            class="form-control border border-2 p-2 form-control-lg @error('old_password') is-invalid @enderror"
                            name="old_password" required autocomplete="current-password">

                        @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-7">
                        <label class="form-label" for="password">Password Baru:</label>
                        <input id="password" type="password"
                            class="form-control border border-2 p-2 form-control-lg @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-7">
                        <label class="form-label" for="password_confirmation">Konfirmasi Password:</label>
                        <input id="password_confirmation" type="password"
                            class="form-control border border-2 p-2 form-control-lg @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" required autocomplete="password">

                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
@endsection
