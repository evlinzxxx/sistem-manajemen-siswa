@extends('layouts.default')

@section('title')
Siswa
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            {{-- <div class="breadcrumb-item"><a href="#">Layout</a></div> --}}
            <div class="breadcrumb-item">@yield('title')</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('siswa.cari') }}" method="GET" class="d-inline">
                <div class="d-flex bd-highlight mb-0 align-items-center">

                        <div class="p-2 bd-highlight">
                            <input type="text" class="form-control form-control-sm" name="cari" placeholder="Cari . . ." autocomplete="off" value="{{$request->cari!=null ? $request->cari : '' }}">
                        </div>
                        <div class="p-2 bd-highlight">
                                <button class="btn btn-info px-4 " type="submit"
                                    value="Cari"> <span class="pcoded-micon"><i class="fas fa-search"></i> Cari </button>


                        </div>
                        <div class="ml-auto p-2 bd-highlight">
                            <x-button-create link="{{route('siswa.create')}}"/>
                        </div>                        
                    </div>
                </form>
                <div class="text-right mb-4">
                    <a href="{{ route('siswa.cetakPDF') }}" class="btn btn-danger text-right">
                        <i class="fas fa-print mr-2"></i> Cetak PDF</i>
                    </a>
                </div>

                <x-jsmultidel link="{{route('siswa.multidel')}}" />

                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif

                <table id="example" class="table table-striped table-bordered mt-0 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th  class="text-center py-2 babeng-min-row" > <input type="checkbox" id="chkCheckAll"> All</th>
                            <th >Nomor Induk</th>
                            <th >Nama</th>
                            <th >Kelas</th>
                            <th >Jenis Kelamin</th>
                            <th >Tahun Pelajaran</th>
                            <th >Nama Wali</th>
                            <th >Nomor Aktif</th>
                            <th class="text-center">Photo</th>
                            <th  class="text-center" >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                            <td class="text-center">
                                    <input type="checkbox" name="ids" class="checkBoxClass " value="{{ $data->id }}"></td>
                                    <td>
                                        {{$data->no_induk}}
                                    </td>
                                    <td>
                                        {{$data->nama}}
                                    </td>
                                    <td>
                                        {{ $data->kelas!=null ? $data->kelases->tingkatan.' '.$data->kelases->jurusan : 'Data tidak ditemukan'}}
                                    </td>
                                    <td>
                                        {{ $data->jenis_kelamin }}
                                    </td>
                                    <td>
                                        {{ $data->tahun_ajaran!=null ? $data->tapel->tahun_ajaran : 'Data tidak ditemukan'}} 
                                    </td>
                                    <td>
                                        {{ $data->wali }}
                                    </td>
                                    <td>
                                        {{ $data->no_hp }}
                                    </td>
                                    <td  class="text-center">
                                        <img src="{{ asset('uploads/' . $data->foto) }}" width="100" alt="">
                                    </td>


                                <td class="text-center babeng-min-row">
                                    {{-- <x-button-reset-pass link="/admin/{{ $pages }}/{{$data->id}}/reset" /> --}}
                                    <x-button-edit link="/admin/{{ $pages }}/{{$data->id}}" />
                                    <x-button-delete link="/admin/{{ $pages }}/{{$data->id}}" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            <div class="d-flex justify-content-between flex-row-reverse mt-3">
                <div >
                    @php
                    $cari=$request->cari;
                    @endphp
                    {{-- {{ $datas->onEachSide(1)
                      ->links() }} --}}

                </div>
                <div >
                    <a href="#" class="btn btn-sm  btn-danger mb-2" id="deleteAllSelectedRecord"
                                onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"  data-toggle="tooltip" data-placement="top" title="Hapus Terpilih">
                                <i class="fas fa-trash-alt mr-2"></i> Hapus Terpilih</i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="ml-3">{{ $datas->links('pagination::bootstrap-4') }}</div>
        </div>
    </div>
</section>
@endsection
