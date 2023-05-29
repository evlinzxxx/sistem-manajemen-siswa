@extends('layouts.default')

@section('title')
Cetak Data Siswa
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('siswa')}}">Siswa</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body text-center">
                @foreach ($tahun as $tahuns)
                <h3>Data tahun ajaran <span class="text-primary">{{ $tahuns->tahun_ajaran }}</span> </h3>
                <h4 class="text-danger">Belum tersedia</h4>
                <img class="mb-3" src="\assets\img\notAvailable.svg" width="500" alt="">
                @endforeach
            </div>
            <div class="text-center mb-5">
                <a href="{{ route('siswa.cetakPDF') }}" type="button" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Kembali" >
                Kembali
                </a>
            </div>
                
        </div>
    </div>
</section>
@endsection
