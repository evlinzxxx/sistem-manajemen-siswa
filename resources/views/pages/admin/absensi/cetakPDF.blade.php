<h1 style="font-size: 24px" align="center">Data Absensi Siswa <br><span style="font-size: 20px">SMP 11 Bengkulu</span></h1>

<h3 style="margin-left:360px; margin-top:50px; font-size: 18px">Tahun Ajaran : <p style="margin-left:490px; margin-top:-38px"> {{ $tahun->tahun_ajaran }}</p></h3>
<h3 style="margin-left:60px; margin-top:-35px; font-size: 18px">Kelas : <p style="margin-left:120px; margin-top:-38px"> {{ $kelases->tingkatan.' '.$kelases->jurusan }} </p></h3>
<h3 style="margin-left:60px; margin-top:10px; font-size: 18px">Tanggal : <p style="margin-left:140px; margin-top:-38px"> {{ $tgl }} </p></h3>
<h3 style="margin-left:360px; margin-top:-360px; font-size: 18px">Jumlah Siswa : <p style="margin-left:490px; margin-top:-38px"> {{ $jml->total_siswa }} Siswa </p></h3>


<div style="padding-left:40px ; padding-right:40px ; margin-top: 30pt">
    <table class="table table-striped table-bordered" style="width:100%;table-layout: fixed; overflow-wrap: break-word;border-collapse: collapse">
      <thead>
        <tr>
          <th style="border: 0.1px solid; padding:2px; width:5%">No</th>
          <th style="border: 0.1px solid; padding:2px; width:17%">Nomor Induk</th>
          <th style="border: 0.1px solid; padding:2px; width:25%">Nama</th>
          <th style="border: 0.1px solid; padding:2px; width:10%">Kelas</th>
          <th style="border: 0.1px solid; padding:2px; width:15%">Jenis Kelamin</th>
          <th style="border: 0.1px solid; padding:2px; width:12%">Absensi</th>
          <th style="border: 0.1px solid; padding:2px">Keterangan</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($datas as $data)
        <tr>
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $loop->index + 1 }}
          </td>
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $data->siswa->no_induk }}
          </td>
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $data->siswa->nama }}
          </td>
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $data->kelases->tingkatan.' '.$data->kelases->jurusan }}
          </td>
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $data->siswa->jenis_kelamin }}
          </td>
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $data->nilai }}
          </td>
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $data->ket }}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>