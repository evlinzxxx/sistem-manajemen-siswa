<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\absensi;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\tapel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminabsensicontroller extends Controller
{
    private $kelas;
    public function index(Request $request)
    {
        #WAJIB
        $pages = 'absensi';
        $tahuns = tapel::all();

        return view('pages.admin.absensi.index', compact('request', 'pages', 'tahuns'));
    }
    public function cari(Request $request)
    {

        $cari = $request->cari;
        #WAJIB
        $pages = 'kelas';
        $datas = kelas::where('tingkatan', 'like', "%" . $cari . "%")
            ->orWhere('jurusan', 'like', "%" . $cari . "%")->paginate(15);

        return view('pages.admin.absensi.index', compact('datas', 'request', 'pages'));
    }

    public function cariTanggal(Request $request)
    {
        $pages = 'laporan';
        $kelas = $request->kelas;
        $tahun = $request->tahun;
        $cari = $request->cari;

        // Proses pencarian data berdasarkan tanggal
        $datas = absensi::where('tgl', $cari)->where('kelas', $kelas)->take(1)->get();
        $dataa = kelas::find($kelas);
        $tahun = tapel::find($tahun);


        // Kirim data ke view
        return view('pages.admin.absensi.laporanDetail', compact('datas', 'request', 'dataa', 'pages', 'tahun'));
    }

    public function cariSiswa(Request $request)
    {
        $pages = 'laporan';
        $tgl = $request->tgl;
        $kelas_id = $request->kelas;
        $tahun_id = $request->tahun;
        $cari = $request->cari;

        // Ambil ID siswa berdasarkan pencarian
        $siswaIds = siswa::where('nama', 'like', "%" . $cari . "%")
            ->where('kelas', $kelas_id)
            ->pluck('id');

        // Ambil data absensi berdasarkan tanggal, kelas, dan siswa yang sesuai dengan pencarian
        $datas = absensi::where('kelas', $kelas_id)
            ->where('tgl', $tgl)
            ->whereIn('siswa_id', $siswaIds)
            ->get();

        $dataa = kelas::find($kelas_id);
        $tahun = tapel::find($tahun_id);

        return view('pages.admin.absensi.laporanShow', compact('datas', 'request', 'dataa', 'tgl', 'pages', 'tahun'));
    }


    public function laporanDetail(Request $request)
    {
        $kelas_id = $request->kelas;
        $tahun_id = $request->tahun;
        $tgl = $request->tgl;
        $pages = 'laporan';
        $datas = absensi::with('kelases')
            ->where('tahun_ajaran', $tahun_id)
            ->where('kelas', $kelas_id)
            ->groupBy('tgl', 'kelas', 'tahun_ajaran')
            ->select('tgl', 'kelas', 'tahun_ajaran', DB::raw('MAX(id) as id'))
            ->get();

        $dataa = kelas::where('id', $kelas_id)->first();
        $tahun = tapel::where('id', $tahun_id)->first();

        return view('pages.admin.absensi.laporanDetail', compact('tgl', 'datas', 'request', 'pages', 'dataa', 'tahun_id', 'tahun'));
    }

    public function laporanShow(Request $request)
    {
        $pages = 'laporan';
        $tgl = $request->tgl;
        $kelas_id = $request->kelas;
        $tahun_id = $request->tahun;
        $dataa = kelas::where('id', $kelas_id)->first();
        $tahun = tapel::where('id', $tahun_id)->first();
        $datas = absensi::where('tahun_ajaran', $tahun_id)->where('kelas', $kelas_id)->where('tgl', $tgl)->get();

        return view('pages.admin.absensi.laporanShow', compact('tgl', 'dataa', 'datas', 'request', 'pages', 'tahun'));
    }

    public function detail($kelas, $tapel, Request $request)
    {
        $re_tapel = $request->tapel;
        $re_kelas = $request->kelas;
        #WAJIB
        $pages = 'absensi';

        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->endOfMonth()->toDateString();
        $period = CarbonPeriod::create($firstDayofPreviousMonth, $lastDayofPreviousMonth);
        // Convert the period to an array of dates
        $dates = $period->toArray();

        $siswas = Siswa::where('tahun_ajaran', $re_tapel)
            ->where('kelas', $re_kelas)
            ->get();

        $kelass = kelas::where('id', $kelas)->first();

        // dd($datas,$this->kelas_id->id);
        return view('pages.admin.absensi.detailv2', compact('request', 'kelas', 'pages', 'kelass', 'dates', 'tapel', 'siswas'));
    }
    public function detail_old(kelas $kelas, Request $request)
    {
        #WAJIB
        $pages = 'absensi';

        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->endOfMonth()->toDateString();
        $period = CarbonPeriod::create($firstDayofPreviousMonth, $lastDayofPreviousMonth);
        // Convert the period to an array of dates
        $dates = $period->toArray();

        // dd($firstDayofPreviousMonth,$lastDayofPreviousMonth);
        $datas = siswa::where('kelas_id', $kelas->id)->paginate(Fungsi::paginationjml());

        return view('pages.admin.absensi.detail', compact('datas', 'request', 'pages', 'kelas', 'dates'));
    }

    public function storev2($kelas, $tapel, Request $request)
    {
        $pages = 'absensi';
        $tgl = $request->tgl;
        // dd($tgl);
        $siswas = Siswa::where('tahun_ajaran', $tapel)->where('kelas', $kelas)->pluck('id')->toArray();
        $siswa = Siswa::where('tahun_ajaran', $tapel)->where('kelas', $kelas)->pluck('id');
        $cek = Absensi::whereIn('siswa_id', $siswas)
            ->where('tgl', $request->tgl)
            ->count();

        if ($cek > 0) {
            foreach ($siswa as $k) {
                $absen = absensi::where('siswa_id', $k)
                    ->where('tgl', $request->tgl)
                    ->update([
                        'ket' => $request->ket[$k],
                        'siswa_id' => $k,
                        'kelas' => $kelas,
                        'tahun_ajaran' => $tapel,
                        'tgl' => $request->tgl,
                        'nilai' => $request->nilai[$k],
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ]);
            }
        } elseif ($cek < 1) {
            foreach ($siswa as $k) {
                $absen = absensi::create([
                    'ket' => $request->ket[$k],
                    'siswa_id' => $k,
                    'kelas' => $kelas,
                    'tahun_ajaran' => $tapel,
                    'tgl' => $request->tgl,
                    'nilai' => $request->nilai[$k],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),

                ]);
            }
        }

        $kelass = Kelas::find($kelas);
        $tapels = Tapel::find($tapel);

        return view('pages.admin.absensi.sukses', compact('kelass', 'pages', 'tgl', 'tapels'));
    }


    public function laporan(Request $request)
    {
        $pages = 'laporan';
        $kelas_id = absensi::select('kelas')->distinct()->pluck('kelas')->toArray();

        // dd($kelas_id);
        $tapel = absensi::with('tahuns')->distinct()->pluck('tahun_ajaran')->toArray();

        $tahun = tapel::whereIn('id', $tapel)->get();

        $datas = kelas::whereIn('id', $kelas_id)->get();

        $absensi = Absensi::with('tahuns', 'kelases')
            ->whereIn('tahun_ajaran', $tapel)
            ->whereIn('kelas', $kelas_id)
            ->select('tahun_ajaran', 'kelas')
            ->distinct()
            ->get();

        $jml = Siswa::whereIn('tahun_ajaran', $tapel)
            ->select('kelas', 'tahun_ajaran', DB::raw('COUNT(*) as total_siswa'))
            ->groupBy('kelas', 'tahun_ajaran')
            ->get();


        return view('pages.admin.absensi.laporan', compact('datas', 'request', 'pages', 'jml', 'tahun', 'absensi'));
    }


    public function destroy(kelas $kelas, absensi $id)
    {
        absensi::destroy($id->id);
        return redirect()->back()->with('status', 'Data berhasil dihapus!')->with('tipe', 'warning')->with('icon', 'fas fa-feather');
    }

    public function destroyAbsen($data, $dataa)
    {
        $kelas = $data;
        $tgl = $dataa;
        $absensi = absensi::where('kelas', $kelas)->where('tgl', $tgl)->delete();

        return redirect()->back();
    }

    public function cariTapel(Request $request)
    {
        $pages = 'absensi';

        $re_tapel = $request->tahun_ajaran;

        $tahun = tapel::where('id', $re_tapel)->get();

        $siswas = Siswa::where('tahun_ajaran', $re_tapel)->pluck('kelas')->toArray();

        $kelas = Kelas::whereIn('id', $siswas)->pluck('id')->toArray();

        $kelases = Kelas::find($siswas);

        $jml = Siswa::where('tahun_ajaran', $re_tapel)
            ->select('kelas', DB::raw('COUNT(*) as total_siswa'))
            ->groupBy('kelas')
            ->get();

        $tahuns = tapel::all();

        if ($siswas != null) {
            return view('pages.admin.absensi.index', compact('kelases', 'pages', 'request', 'tahuns', 'jml', 're_tapel'));
        } else {
            return view('pages.admin.absensi.notAvailable', compact('pages', 'tahun'));
        }
    }

    public function cetakPDF($tahun, $kelas, $tgl)
    {
        $datas = absensi::where('tahun_ajaran', $tahun)->where('kelas', $kelas)->where('tgl', $tgl)->get();


        $jml = Absensi::where('tahun_ajaran', $tahun)
            ->where('kelas', $kelas)
            ->where('tgl', $tgl)
            ->select('kelas', DB::raw('COUNT(*) as total_siswa'))
            ->groupBy('kelas')
            ->first();


        $kelases = kelas::where('id', $kelas)->first();
        $tingkatan = $kelases->tingkatan;
        $tahun = tapel::where('id', $tahun)->first();
        $tgl = $formattedDate = date("j F Y", strtotime($tgl));
        $namaPdf = 'Data Absensi Siswa Kelas-' . $tingkatan . $kelases->jurusan;

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'pages.admin.absensi.cetakPDF',
            compact('datas', 'kelases', 'tahun', 'jml', 'tgl')
        );

        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream($namaPdf . '.pdf');
    }
}
