@extends('layouts.default')

@section('title')
Laporan Absensi
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">

                @if($absensi->count()>0)
                <x-jsdatatable/>
                @endif

                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th width="5%" class="text-center py-2">
                                No</th>
                            <th >Nama Kelas</th>
                            <th >Tahun Ajaran</th>
                            <th >Jumlah Siswa</th>
                            <th >Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($absensi as $data)
                        <tr>
                                <td class="text-center">
                                    {{ ((($loop->index)+1)) }}</td>
                                <td>
                                    {{$data->kelases->tingkatan.' '.$data->kelases->jurusan}}
                                </td>
                                <td>
                                    {{$data->tahuns->tahun_ajaran}}
                                </td>
                                <td>
                                    @foreach ($jml as $jumlah)
                                    @if ($jumlah->kelas == $data->kelases->id && $jumlah->tahun_ajaran == $data->tahuns->id)
                                        {{ $jumlah->total_siswa }}
                                    @endif
                                @endforeach 
                                </td>
                                <td class="text-center babeng-min-row">
                                    <a href="{{ route('laporan.detail', ['tahun' => $data->tahuns->id, 'kelas' => $data->kelases->id]) }}" type="button" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat laporan {{ $data->kelases->tingkatan.' '.$data->kelases->jurusan }}">
                                    <i class="fas fa-eye"></i>
                                </a>
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
<div class="d-flex justify-content-between flex-row-reverse mt-3">
    <div >
{{-- {{ $datas->links() }} --}}
    </div>
</div>
            </div>
        </div>
    </div>
</section>
@endsection
