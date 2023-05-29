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
            <div class="card-body">

                <div class="card p-4 mb-5">
                    <h3>Cari Data</h3>
                        <form action="{{ route('siswa.cariPDF') }}" method="get">
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

                <table id="example" class="table table-striped table-bordered mt-0 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Kelas</th>
                            <th class="text-center">Jumlah Siswa</th>
                            <th  class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    @isset($kelases)
                    @foreach ($kelases as $data)
                        <tr class="text-center">
                            <td class="text-center">
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ $data->tingkatan }} {{ $data->jurusan }}
                            </td>
                            <td>
                                @foreach($jml as $siswa)
                                @if($siswa->kelas == $data->id)
                                    {{ $siswa->total_siswa }}
                                @endif
                                @endforeach
                            </td>
                            <td class="text-center babeng-min-row">
                                <form action="{{ route('siswa.cetakKelasPDF', ['tapel'=>$re_tapel ,'kelas'=>$data->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" target="_blank" class="btn btn-danger"><i class="fas fa-print px-2"></i></button>
                                  </form>
                            </td>
                        </tr>
                    @endforeach
                @endisset
            <div class="d-flex justify-content-between flex-row-reverse mt-3">
                <div >

                </div>
                
                    </div>
                </div>
        </div>
    </div>
</section>
@endsection
