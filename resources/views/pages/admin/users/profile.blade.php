@extends('layouts.default')

@section('title')
Administrator
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('users')}}">@yield('title')</a></div>
            <div class="breadcrumb-item">Profile</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Profile</h5>
            </div>
            <div class="card-body">

                    <div class="row">

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="name">Nama Lengkap <code>*)</code></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name') ? old('name') : $id->name}}" required>
                        @error('name')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="username">Username<code></code></label>

                        <input type="text" class="form-control  @error('username') is-invalid @enderror" name="username" required  value="{{old('username') ? old('username') : $id->username}}">

                        @error('username')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="email">Email<code></code></label>

                        <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email" required  value="{{old('email') ? old('email') : $id->email}}">

                        @error('email')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    </div>

                    <div class="card-footer text-right mr-5">
                        <a href="{{route('users.edit', Auth::user()->id)}}"  class="btn btn-warning">Edit</a>
                    </div>

            </div>
        </div>
    </div>
</section>
@endsection
