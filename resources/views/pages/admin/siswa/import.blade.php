@extends('layouts.default')

@section('title')
Import Data Siswa
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
                <form action="{{ route('siswa.ImportExcel') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                        @csrf

                     <div class="form-group col-md-8">
                        <label class="text-primary">Data dalam format excel</label>
                        <input class="form-control" type="file" id="file" name="file" required>    
                    </div>   

                    <div class="mb-5 ml-3">
                        <button type="submit" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Import" >
                            Import Data
                        </button>
                    </div>
                </div>
                    
                </form>
        </div>
    </div>
</section>
@endsection
