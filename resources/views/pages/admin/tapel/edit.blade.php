@extends('layouts.default')

@section('title')
Tahun Pelajaran
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('tapel')}}">@yield('title')</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Edit &raquo; <span class="text-primary">{{ $id->tahun_ajaran }}</span></h5>
            </div>
            <div class="card-body">

                <form action="{{route('tapel.update',$id->id)}}" method="post">
                    @method('put')
                    @csrf

                    <div class="row">

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="nama">Nama Tahun Pelajaran  <code>*)</code></label>
                        <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" value="{{old('tahun_ajaran') ? old('tahun_ajaran') : $id->tahun_ajaran}}" required>
                        @error('tahun_ajaran')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>


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
