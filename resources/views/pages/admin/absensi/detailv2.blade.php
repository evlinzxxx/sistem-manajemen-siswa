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
            <div class="card-body" >
                <form action="{{ route('absensi.storev2',['tapel'=>$tapel ,'kelas'=>$kelas]) }}" method="post" class="d-inline">
                    @csrf
                    <div class="p-1 bd-highlight mb-4">
                        <label for="">Pilih Tanggal <span class="text-primary">(Bulan / Tanggal / Tahun)</span> </label>
                        <input type="date" class="form-control" value="{{date('Y-m-d')}}" name="tgl">
                  </div>

                  @if($siswas->count()>0)
                  <x-jsdatatable/>
                  @endif
                      
                      <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%" >
                        <thead>
                            <tr style="background-color: #F1F1F1">
                            <th width="5%" class="text-center py-2">
                                No</th>
                            <th class="text-center" >No Induk</th>
                            <th class="text-center" >Nama</th>
                            <th class="text-center">Kelas</th>
                            <th class="text-center">Jenis Kelamin</th>
                            <th class="text-center">Hadir / Sakit / Izin / Alpha</th>
                            <th class="text-center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswas as $data)
                        <tr id="sid{{ $data->id }}">
                            <input type="hidden" name="siswa_id" value="{{ $data->id }}">
                            <input type="hidden" name="kelas" value="{{ $data->kelases->id }}">
                            <input type="hidden" name="tahun_ajaran" value="{{ $data->tapel->id }}">
                                <td class="text-center">
                                    {{ ((($loop->index)+1)) }}</td>
                                <td>
                                    {{ $data->no_induk }}    
                                </td>    
                                <td class="text-center">
                                    {{$data!=null?Str::limit($data->nama,25,' ...'):'Data tidak ditemukan'}}
                                </td>
                                <td class="text-center">
                                    {{ $data->kelas != null ? $data->kelases->tingkatan.' '.$data->kelases->jurusan : 'Data tidak ditemukan' }}
                                </td>
                                <td class="text-center">
                                    {{ $data->jenis_kelamin }}
                                </td>
                                <td class="text-center">
                                    <div class="selectgroup w-20" value="{{ $data->id }}">
                                        <label class="selectgroup-item">
                                          <input type="radio" name="nilai[{{ $data->id }}]" value="Hadir" class="selectgroup-input" checked="">
                                          <span class="selectgroup-button">Hadir</span>
                                        </label>
                                        <label class="selectgroup-item">
                                          <input type="radio" name="nilai[{{ $data->id }}]" value="Sakit" class="selectgroup-input">
                                          <span class="selectgroup-button">S</span>
                                        </label>
                                        <label class="selectgroup-item">
                                          <input type="radio" name="nilai[{{ $data->id }}]" value="Ijin" class="selectgroup-input">
                                          <span class="selectgroup-button">I</span>
                                        </label>
                                        <label class="selectgroup-item">
                                          <input type="radio" name="nilai[{{ $data->id }}]" value="Alpha" class="selectgroup-input">
                                          <span class="selectgroup-button">A</span>
                                        </label>
                                      </div>
                                </td>
                                <td class="text-center">
                                    <div class="p-2 bd-highlight">
                                        <input type="text" class="form-control" value="{{old('ket')}}" placeholder="Keterangan" name="ket[{{ $data->id }}]">
                                  </div>  
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
                <div>
                    <input class="btn btn-info" type="submit" id="babeng-submit"value="Simpan">
               </div>
            </div>
            </div>    
        </div>
    </div>
</form>
</section>
@endsection


{{-- @section('containermodal')
              {{-- modal absensi --}}
              {{-- @foreach ($datas as $data)
                  @foreach ($dates as $d)

                              @php
                                  $i=$loop->index;
                                  $tgl=$dates[$i]->format('Y-m-d');
                                  $tgl2=$dates[$i]->format('d');
                              @endphp

              <div class="modal fade" id="modal{{$data->id}}-{{$tgl}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form method="post" action="{{route('absensi.store',$kelas->id)}}" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> {{$data->nama}} - {{Fungsi::tanggalindo($tgl)}}</h5>
                      </div>
                      <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group col-md-12 col-12 mt-0">
                            <label for="nama">Pilih Absensi </label>
                        <input type="hidden" name="siswa_id" value="{{$data->id}}">
                        <input type="hidden" name="tgl" value="{{$tgl}}">
                        <select class="form-control form-control-sm" name="ket">
                            <option selected>-</option>
                            <option>Ijin</option>
                            <option>Sakit</option>
                            <option>Tanpa Keterangan</option>


                        </select>
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>



                  @endforeach

              @endforeach

@endsection  --}}
