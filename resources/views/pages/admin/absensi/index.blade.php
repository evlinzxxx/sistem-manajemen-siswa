@extends('layouts.default')

@section('title')
Absensi
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
                <div class="card p-4 mb-5">
                    <h3>Cari Data</h3>
                        <form action="{{ route('absensi.cariTapel') }}" method="get">
                            <div class="row">
                                <div class="col-2">
                                    <label for="">Pilih Tahun Ajaran</label>
                                    <select class="js-example-basic-single form-control-sm @error('tahun_ajaran')
                                    is-invalid
                                    @enderror" name="tahun_ajaran"  style="width: 75%" required>
                                    <option disabled selected>{{ $request->cari_tingkatan }}</option>
                                    @foreach ($tahuns as $tahun)
                                        <option value="{{ $tahun->id }}"> {{ $tahun->tahun_ajaran }}</option>
                                    @endforeach
                                  </select>
                                </div>
                
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i><span class="px-2">Cari</span></button>
                                </div>
                            </div>
                        </form>
                </div>

                @isset($kelases)
                @if($kelases->count()>0)
                <x-jsdatatable/>
                @endif
                @endisset

                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th  class="text-center py-2 babeng-min-row" >No</th>
                            <th >Nama Kelas</th>
                            <th >Jumlah</th>
                            <th >Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($kelases)
                        @forelse ($kelases as $data)
                        <tr id="sid{{ $data->id }}">
                            <td class="text-center">
                                {{ ((($loop->index)+1)) }}</td>
                                <td>
                                    {{$data->tingkatan.' '.$data->jurusan}}
                                </td>
                                <td>
                                    @foreach($jml as $siswa)
                                    @if($siswa->kelas == $data->id)
                                        {{ $siswa->total_siswa }}
                                    @endif
                                    @endforeach
                                </td>
                                <td class="text-center babeng-min-row">
                                <a href="{{route('absensi.detail',['tapel'=>$re_tapel ,'kelas'=>$data->id])}}" type="button" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Input Absensi Siswa!" >
                                   <i class="fas fa-id-card-alt"></i>
                                </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                        @endisset
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
