@extends('layouts.default')

@section('title')
Absensi {{$kelass->tingkatan}} {{$kelass->jurusan}} 
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('absensi')}}">Absensi</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body text-center" >
                <h3>Data absensi <span class="text-primary">{{ $kelass->tingkatan }}{{ $kelass->jurusan }}</span> </h3>
                <h6>Tanggal : {{ $tgl }}</h6>
                <img class="mb-3" src="\assets\img\success.svg" width="500" alt="">
                <h4>Berhasil ditambahkan!</h4>
                <p>Lihat laporan absensi disini!</p>
                <a href="{{ route('laporan.detail',['tahun'=>$tapels->id, 'kelas'=>$kelass->id]) }}" type="button" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Laporan Absensi" >
                    <i class="fas fa-id-card-alt mr-2"></i>Lihat laporan
                </a>
            </div>    
        </div>
    </div>
</section>

@endsection