<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\siswa;
use App\Models\tapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class admindashboardcontroller extends Controller
{
    public function index()
    {
        $pages = 'dashboard';
    
        $jml_tahun = tapel::get()->count();
        $jml_kelas = kelas::get()->count();
        $jml_siswa = siswa::get()->count();

        // $jml_lk = siswa::where('tahun_ajaran', )->get()->count();
        // $jml_pr = siswa::where('tahun_ajaran', )->get()->count();
    
        $cek = tapel::all();
        $tahun_ajaran = tapel::pluck('tahun_ajaran')->toArray();
        $tahun = tapel::pluck('id')->toArray();
        $siswa = siswa::where('tahun_ajaran', $tahun)->get();
    
        
        if ($cek != null) {
            $dataSiswaPerTahunLk = []; // Definisikan variabel $dataSiswaPerTahun
            $dataSiswaPerTahunPr = []; // Definisikan variabel $dataSiswaPerTahun
            foreach ($tahun as $idTahun) {
                $siswa_lk = Siswa::where('tahun_ajaran', $idTahun)->where('jenis_kelamin', 'Laki-laki')->get();
                $siswa_pr = Siswa::where('tahun_ajaran', $idTahun)->where('jenis_kelamin', 'Perempuan')->get();
                $dataSiswaPerTahunLk[$idTahun] = $siswa_lk->count();
                $dataSiswaPerTahunPr[$idTahun] = $siswa_pr->count();
            }
            // dd($dataSiswaPerTahun);
        }
        
        return view('pages.admin.dashboard.index', compact('pages', 'jml_tahun', 'jml_kelas', 'jml_siswa', 'tahun_ajaran', 'dataSiswaPerTahunLk', 'dataSiswaPerTahunPr'));
    }
    
}
