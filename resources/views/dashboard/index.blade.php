@extends('layout.main')

@Section('container')
    <h2>Welcome {{ auth()->user()->nama }}</h2>
@endsection
