@extends('layouts.default')

@section('title')
{{$dataa->tingkatan.' '.$dataa->jurusan}}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('laporan')}}">Laporan Absensi</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">

                <div id="babeng-bar" class="text-left mt-2">

                    <div id="babeng-row ">

                        <form action="{{ route('laporan.cariTanggal', ['tahun' => $tahun->id, 'kelas' => $dataa->id]) }}" method="GET">
                            <input type="date" class="babeng babeng-select ml-0" placeholder="Cari . . ." name="cari">
                            
                            <!-- Tambahkan input hidden untuk menyimpan ID kelas -->
                            <input type="hidden" name="kelas" value="{{ $dataa->id }}">
                        
                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit" value="Cari">
                            </span>
                        </form>
                        
                    </div>
                </div>
                

                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif

                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th width="5%" class="text-center py-2">
                                No</th>
                            <th >Tanggal</th>
                            <th class="text-center" >Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr>
                            <td class="text-center">
                                {{ ((($loop->index)+1)) }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($data->tgl)->format('j F Y') }}
                                </td>
                                <td class="text-center babeng-min-row">
                                    <a href="{{ route('laporan.detailAbsen', ['tahun'=>$data->tahun_ajaran, 'kelas'=>$data->kelas, 'tgl'=>$data->tgl]) }}" type="button" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat laporan" >
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <x-button-delete link="/admin/laporan/{{$data->kelas}}/{{ $data->tgl }}" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

@php
$cari=$request->cari;
@endphp
            </div>
        </div>
    </div>
</section>
@endsection
