<h1 style="font-size: 24px" align="center">Data Siswa SMP 11 Bengkulu</h1>

<h3 style="margin-left:80px; margin-top:50px; font-size: 18px">Kelas : <p style="margin-left:150px; margin-top:-40px"> {{ $kelases->tingkatan.' '.$kelases->jurusan }} </p></h3>
<h3 style="margin-left:80px; margin-top:20px; font-size: 18px">Jumlah Siswa : <p style="margin-left:210px; margin-top:-38px"> {{ $jml->total_siswa }} Siswa </p></h3>
<h3 style="margin-left:80px; margin-top:5px; font-size: 18px">Tahun Ajaran : <p style="margin-left:210px; margin-top:-38px"> {{ $tahun->tahun_ajaran }}</p></h3>


<div style="padding-left:70px ; padding-right:70px ; margin-top: 30pt">
    <table class="table table-striped table-bordered" style="width:100%;table-layout: fixed; overflow-wrap: break-word;border-collapse: collapse">
      <thead>
        <tr>
          <th style="border: 0.1px solid; padding:2px; width:5%">No</th>
          <th style="border: 0.1px solid; padding:2px; width:18%">Nomor Induk</th>
          <th style="border: 0.1px solid; padding:2px">Nama</th>
          <th style="border: 0.1px solid; padding:2px;width:18%">Jenis Kelamin</th>
          <th style="border: 0.1px solid; padding:2px">Nama Wali</th>
          <th style="border: 0.1px solid; padding:2px">Nomor Aktif</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($siswa as $data)
        <tr>
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $loop->index + 1 }}
          </td>
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $data->no_induk }}
          </td>
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $data->nama }}
          </td>
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $data->jenis_kelamin }}
          </td>
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $data->wali }}
          </td>
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $data->no_hp }}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>