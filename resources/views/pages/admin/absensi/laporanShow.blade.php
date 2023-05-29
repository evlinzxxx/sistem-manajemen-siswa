@extends('layouts.default')

@section('title')
Absensi {{ \Carbon\Carbon::parse($tgl)->format('j F Y') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('laporan')}}">Laporan Absensi</a></div>
            {{-- <div class="breadcrumb-item"><a href="{{route('laporan.detail', ['tahun'=>$tahun_id, 'kelas'=>$kelas_id, 'tgl'=>$tgl])}}">{{ $dataa->tingkatan.' '.$dataa->jurusan }}</a></div> --}}
            <div class="breadcrumb-item">@yield('title')</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body" >
                
                <form action="{{ route('laporan.cariSiswa') }}" method="GET" class="d-inline">
                    <div class="d-flex bd-highlight mb-0 align-items-center">
                        <div class="p-2 bd-highlight">
                            <input type="text" class="form-control form-control-sm" name="cari" placeholder="Cari nama siswa.." autocomplete="off" value="{{$request->cari!=null ? $request->cari : '' }}">
                            <input type="hidden" name="kelas" value="{{ $dataa->id }}">
                            <input type="hidden" name="tahun" value="{{ $tahun->id }}">
                            <input type="hidden" name="tgl" value="{{ $tgl }}">
                        </div>
                        <div class="p-2 bd-highlight">
                            <button class="btn btn-info px-4 " type="submit" value="Cari">
                                <span class="pcoded-micon"><i class="fas fa-search"></i> Cari</span>
                            </button>
                        </div>
                    </div>
                </form>
                

                <div class="text-right mb-4 mr-3">
                    <form action="{{ route('laporan.cetakPDF', ['tahun'=>$tahun->id, 'kelas'=>$dataa->id, 'tgl'=>$tgl]) }}" method="POST">
                        @csrf
                        <button type="submit" target="_blank" class="btn btn-danger text-right"><i class="fas fa-print mr-2"></i> Cetak PDF</i></button>
                      </form>
                </div>
                    
                    @if($datas->count()>0)
                        <x-jsdatatable/>
                    @endif

                      <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%" >
                        <thead>
                            <tr style="background-color: #F1F1F1">
                            <th class="text-center" >No</th>
                            <th class="text-center" >Nama</th>
                            <th class="text-center">Kelas</th>
                            <th class="text-center">Jenis Kelamin</th>
                            <th class="text-center">Hadir / Sakit / Izin / Alpha</th>
                            <th class="text-center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                            <input type="hidden" name="kelas" value="{{ $data->kelases->id }}">
                                <td class="text-center">
                                    {{ ((($loop->index)+1)) }}    
                                </td>    
                                <td class="text-center">
                                    {{$data!=null?Str::limit($data->siswa->nama,25,' ...'):'Data tidak ditemukan'}}
                                </td>
                                <td class="text-center">
                                    {{ $data->kelas != null ? $data->kelases->tingkatan.' '.$data->kelases->jurusan : 'Data tidak ditemukan' }}
                                </td>
                                <td class="text-center">
                                    {{ $data->siswa->jenis_kelamin }}
                                </td>
                                <td class="text-center">
                                    {{ $data->nilai }}
                                </td>
                                <td class="text-center">
                                    {{ $data->ket }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                      </table>
            <div class="d-flex justify-content-between mt-3">
                <div>
                    @php
                    $cari=$request->cari;
                    @endphp
                    {{-- {{ $datas->links() }} --}}
                </div>
            </div>
            </div>    
        </div>
    </div>
{{-- </form> --}}
</section>
@endsection

