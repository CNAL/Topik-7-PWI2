@extends('layouts.master')

@section('content')
<h1>Selamat Datang di Halaman About</h1>
<div class="card">
    <div class="card-body">
        Selamat datang {{ $nama }},
        dari kelas {{ $kelas }}
        dengan NIM {{ $nim }}.
    </div>
</div>
@endsection
