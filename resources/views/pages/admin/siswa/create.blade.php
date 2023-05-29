@extends('layouts.default')

@section('title')
Siswa
@endsection

@push('before-script')

@if (session('status'))
<x-sweetalertsession tipe="{{session('tipe')}}" status="{{session('status')}}"/>
@endif
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('siswa')}}">@yield('title')</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Tambah</h5>
            </div>
            <div class="card-body">

                <form action="{{route('siswa.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="no_induk">Nomor Induk<code>*)</code></label>
                        <input type="text" name="no_induk" id="no_induk" class="form-control @error('no_induk') is-invalid @enderror" value="{{old('no_induk')}}" required>
                        @error('no_induk')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="nama">Nama Lengkap<code>*)</code></label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{old('nama')}}" required>
                        @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>


                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="tempat_lahir">Tempat Lahir<code>*)</code></label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{old('tempat_lahir')}}" required>
                        @error('tempat_lahir')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="tgl_lahir">Tanggal Lahir<code>*)</code></label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{old('tgl_lahir')}}" required>
                        @error('tgl_lahir')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>


                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="agama">Pilih Agama <code></code></label>

                        <select class="form-control  @error('agama') is-invalid @enderror" name="agama" required>
                            <option disabled selected>Pilih Agama</option>
                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : null }}>Islam</option>
                            <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : null }}>Kristen</option>
                            <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : null }}>Katolik</option>
                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : null }}>Hindu</option>
                            <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : null }}>Budha</option>
                            <option value="Konghucu"{{ old('agama') == 'Konghucu' ? 'selected' : null }}>Konghucu</option>
                        </select>
                        @error('agama')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="alamat">Alamat<code>*)</code></label>
                        <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{old('alamat')}}" required>
                        @error('alamat')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="jenis_kelamin">Pilih Jenis Kelamin <code></code></label>

                        <select class="form-control  @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required>
                            <option disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : null }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : null }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>


                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="wali">Nama Wali<code>*)</code></label>

                        <input type="text" name="wali" id="wali" class="form-control @error('wali') is-invalid @enderror" value="{{old('wali')}}" required>
                        @error('wali')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="kelas">Pilih Kelas <code></code></label>

                        <select class="form-control  @error('kelas') is-invalid @enderror" name="kelas" required>
                            <option disabled selected>Pilih Kelas</option>
                            @forelse ($kelas as $d)
                            <option value="{{$d->id}}" {{ old('kelas') == $d->id ? 'selected' : null }}>{{$d->tingkatan.' '.$d->jurusan}}</option>
                            @empty
                            <option value=""> Data belum tersedia</option>
                            @endforelse
                        </select>
                        @error('kelas')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>
                    
                    
                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="no_hp">Nomor yang bisa dihubungi<code>*)</code></label>
                        <input type="number" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{old('no_hp')}}" required>
                            @error('no_hp')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                    </div>


                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="tahun_ajaran">Pilih Tahun Pelajaran <code></code></label>

                        <select class="form-control  @error('tahun_ajaran') is-invalid @enderror" name="tahun_ajaran" required>
                            <option disabled selected>Pilih Tahun Pelajaran</option>
                            @forelse ($tapel as $d)
                                <option value="{{$d->id}}" {{ old('tahun_ajaran') == $d->id ? 'selected' : null }}>{{$d->tahun_ajaran}}</option>
                            @empty
                                <option value=""> Data belum tersedia</option>
                            @endforelse
                        </select>
                        @error('tahun_ajaran')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

        
                    <div class="form-group col-md-1 col-1 mt-0 ml-5">
                      <div id="image-preview" class="image-preview">
                        <label for="image-upload" id="image-label2">UPLOAD FOTO</label>
                        <input type="file" name="foto" id="image-upload" class="@error('foto')
                        is_invalid
                    @enderror"  accept="image/png, image/gif, image/jpeg" onchange="document.getElementById('output').src=window.URL.createObjectURL(this.files[0])" />

                    @error('foto')<div class="invalid-feedback"> {{$message}}</div>
                    @enderror
                </div>
            </div>
            
            
            <div class="form-group col-md-5 col-5 text-right"><img src="" id="output" width="300"></div>
                    </div>

                    <div class="card-footer text-right mr-5">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</section>
@endsection
