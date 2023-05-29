@extends('layouts.default')

@section('title')
Kelas 
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('kelas')}}">@yield('title')</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Edit &raquo; <span class="text-primary">{{ $id->tingkatan }} {{ $id->jurusan }}</span> </h5>
            </div>
            <div class="card-body">

                <form action="{{route('kelas.update',$id->id)}}" method="post">
                    @method('put')
                    @csrf

                    <div class="row">
                    <div class="form-group col-md-3 col-3 mt-0 ml-5">
                        <label class="form-label">Pilih Tingkatan</label>
                        <div class="selectgroup w-100">
                          <label class="selectgroup-item">
                            <input type="radio" name="tingkatan" value="VII" class="selectgroup-input" {{$id->tingkatan=='VII' ? 'checked=""' : ''}}>
                            <span class="selectgroup-button">VII</span>
                          </label>
                          <label class="selectgroup-item">
                            <input type="radio" name="tingkatan" value="VIII" class="selectgroup-input"  {{$id->tingkatan=='VIII' ? 'checked=""' : ''}}>
                            <span class="selectgroup-button">VIII</span>
                          </label>
                          <label class="selectgroup-item">
                            <input type="radio" name="tingkatan" value="IX" class="selectgroup-input"  {{$id->tingkatan=='IX' ? 'checked=""' : ''}}>
                            <span class="selectgroup-button">IX</span>
                          </label>

                        </div>
                      </div>
                      <div class="form-group col-md-6 col-6 mt-0 ml-5">
                        <label class="form-label">Pilih Jurusan</label>
                        <div class="selectgroup w-100">
                          <label class="selectgroup-item">
                            <input type="radio" name="jurusan" value="A" class="selectgroup-input" {{$id->jurusan=='A' ? 'checked=""' : ''}}>
                            <span class="selectgroup-button">A</span>
                          </label>
                          <label class="selectgroup-item">
                            <input type="radio" name="jurusan" value="B" class="selectgroup-input" {{$id->jurusan=='B' ? 'checked=""' : ''}}>
                            <span class="selectgroup-button">B</span>
                          </label>
                          <label class="selectgroup-item">
                            <input type="radio" name="jurusan" value="C" class="selectgroup-input" {{$id->jurusan=='C' ? 'checked=""' : ''}}>
                            <span class="selectgroup-button">C</span>
                          </label>
                          <label class="selectgroup-item">
                            <input type="radio" name="jurusan" value="D" class="selectgroup-input" {{$id->jurusan=='D' ? 'checked=""' : ''}}>
                            <span class="selectgroup-button">D</span>
                          </label>
                          <label class="selectgroup-item">
                            <input type="radio" name="jurusan" value="E" class="selectgroup-input" {{$id->jurusan=='E' ? 'checked=""' : ''}}>
                            <span class="selectgroup-button">E</span>
                          </label>
                          <label class="selectgroup-item">
                            <input type="radio" name="jurusan" value="F" class="selectgroup-input" {{$id->jurusan=='F' ? 'checked=""' : ''}}>
                            <span class="selectgroup-button">F</span>
                          </label>
                          <label class="selectgroup-item">
                            <input type="radio" name="jurusan" value="G" class="selectgroup-input" {{$id->jurusan=='G' ? 'checked=""' : ''}}>
                            <span class="selectgroup-button">G</span>
                          </label>
                          <label class="selectgroup-item">
                            <input type="radio" name="jurusan" value="H" class="selectgroup-input" {{$id->jurusan=='H' ? 'checked=""' : ''}}>
                            <span class="selectgroup-button">H</span>
                          </label>
                          <label class="selectgroup-item">
                            <input type="radio" name="jurusan" value="I" class="selectgroup-input" {{$id->jurusan=='I' ? 'checked=""' : ''}}>
                            <span class="selectgroup-button">H</span>
                          </label>
                        </div>
                      </div>
                        </div>
                  
                        <div class="card-footer text-right ml-5">
                          <button class="btn btn-primary">Simpan</button>
                      </div>
                </form>


            </div>
        </div>
    </div>
</section>
@endsection
