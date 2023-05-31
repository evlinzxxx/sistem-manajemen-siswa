@extends('layouts.default')

@section('title')
Beranda
@endsection


@section('content')
        <section class="section">
            <div class="section-header">
            <h1>@yield('title')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-4 col-md-5 col-sm-5">
                      <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="card-wrap">
                          <div class="card-header">
                            <h4>Jumlah Siswa</h4>
                          </div>
                          <div class="card-body">
                            {{$jml_siswa}} Siswa
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-school"></i>
                        </div>
                        <div class="card-wrap">
                          <div class="card-header">
                            <h4>Jumlah Kelas</h4>
                          </div>
                          <div class="card-body">
                            {{$jml_kelas}} Kelas 
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                      <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="card-wrap">
                          <div class="card-header">
                            <h4>Jumlah Tahun Ajaran</h4>
                          </div>
                          <div class="card-body">
                            {{ $jml_tahun }} Tahun
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fab fa-monero"></i>
                        </div>
                        <div class="card-wrap">
                          <div class="card-header">
                            <h4>Jumlah User</h4>
                          </div>
                          <div class="card-body">
                            0 User
                          </div>
                        </div>
                      </div>
                    </div> --}}
                  </div>
                  
                @if(($dataSiswaPerTahunLk==null) && ($dataSiswaPerTahunPr==null))
                <div class="row">
                  <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                      <div class="card-header">
                            <br><span><h4>Data siswa belum tersedia</h4></span>
                      </div>
                    <div class="card-body">
                      <canvas id="container"></canvas>
                    </div>
                  </div>
                </div>
              </div>
                
              @elseif(($dataSiswaPerTahunLk!=null) || ($dataSiswaPerTahunPr!=null))
                
              <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                  <div class="card">
                    <div class="card-header">
                        <h3>Grafik Jumlah Siswa 
                          <br><span><h4>Per Tahun Ajaran</h4></span></h3>
                    </div>
                    <div class="card-body">
                      <div id="container"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

@push('after-style')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    $(document).ready(function () {
        var labels = {!! json_encode($tahun_ajaran) !!};
        var dataLk = {!! json_encode(array_values($dataSiswaPerTahunLk)) !!};
        var dataPr = {!! json_encode(array_values($dataSiswaPerTahunPr)) !!};

        var minValue = Math.min(...dataLk, ...dataPr); // Get the minimum value from the data

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jumlah Siswa per Tahun Ajaran'
            },
            subtitle: {
                text: 'Source: Your Data Source'
            },
            xAxis: {
                categories: labels
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Siswa'
                }
            },
            tooltip: {
                pointFormatter: function () {
                    var seriesName = this.series.name;
                    var dataValue = seriesName === 'Siswa' ? dataLk[this.x] : dataPr[this.x];
                    return '<span style="color:' + this.color + '">\u25CF</span> ' + seriesName + ': ' + dataValue;
                }
            },
            series: [{
                name: 'Siswa',
                data: dataLk,
                color: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                name: 'Siswi',
                data: dataPr,
                color: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        });
    });
</script>


@endpush
@endif
@endsection


