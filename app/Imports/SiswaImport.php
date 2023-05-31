<?php

namespace App\Imports;

use App\Models\kelas;
use App\Models\Siswa;
use App\Models\tapel;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $tingkatanJurusan = $row[15]; // Ambil nilai kelas dari data excel

        // Pisahkan tingkatan dan jurusan dari nilai kelas
        $tingkatan = substr($tingkatanJurusan, 0, strpos($tingkatanJurusan, ' '));
        $jurusan = substr($tingkatanJurusan, strpos($tingkatanJurusan, ' ') + 1);

        // Cari id kelas berdasarkan tingkatan dan jurusan dalam tabel kelas
        $kelasModel = Kelas::where('tingkatan', $tingkatan)
            ->where('jurusan', $jurusan)
            ->first();

        // Jika id kelas ditemukan, gunakan nilainya untuk kolom 'kelas' dalam model Siswa
        if ($kelasModel) {
            $kelasId = $kelasModel->id;
        } else {
            $kelasId = null; // Nilai default jika id kelas tidak ditemukan
        }

        $tapel = $row[16]; // Ambil tahun ajaran dari data excel

        // Cari id tahun ajaran berdasarkan tahun_ajaran dalam tabel tapel
        $tapelModel = Tapel::where('tahun_ajaran', $tapel)->first();

        // Jika id tapel ditemukan, gunakan nilainya untuk kolom 'tahun_ajaran' dalam model Siswa
        if ($tapelModel) {
            $tapelId = $tapelModel->id;
        } else {
            $tapelId = null; // Nilai default jika id tapel tidak ditemukan
        }



        return new Siswa([
            'nama' => $row[0],
            'no_induk' => isset($row[2]) ? $row[2] : '0000000000',
            'agama' => $row[5],
            'tempat_lahir' => $row[3],
            'tgl_lahir' => $row[4],
            'alamat' => $row[6] . ' ' . $row[10] . ' ' . $row[11] . ' ' . $row[12],
            'no_hp' => isset($row[13]) ? $row[13] : null,
            'jenis_kelamin' => $row[1],
            'kelas' => $kelasId, // Gunakan id kelas yang sudah dikonversi
            'wali' => $row[14],
            'tahun_ajaran' => $tapelId,
            'foto' => isset($row[17]) ? $row[17] : 'default_user.png',
        ]);
    }
}
