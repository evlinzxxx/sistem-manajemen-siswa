<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\tapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class adminsiswacontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages = 'siswa';
        $kelas = Kelas::all();
        $datas = Siswa::paginate(15);

        return view('pages.admin.siswa.index', compact('datas', 'request', 'pages', 'kelas'));
    }
    public function cari(Request $request)
    {

        $cari = $request->cari;
        #WAJIB
        $pages = 'siswa';
        $datas = siswa::where('nama', 'like', "%" . $cari . "%")
            ->orWhere('no_induk', 'like', "%" . $cari . "%")
            ->orWhere('no_hp', 'like', "%" . $cari . "%")
            ->orWhere('wali', 'like', "%" . $cari . "%")
            ->paginate(15);
        return view('pages.admin.siswa.index', compact('datas', 'request', 'pages'));
    }

    public function create()
    {
        $pages = 'siswa';

        $tapel = DB::table('tapel')->get();

        $kelas = DB::table('kelas')->get();

        return view('pages.admin.siswa.create', compact('pages', 'tapel', 'kelas'));
    }

    public function store(Request $request, siswa $siswa)
    {
        $inputs = $request->all();

        //validasi data
        $request->validate([
            'no_induk' => 'required|size:10',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date|before_or_equal:' . Carbon::now()->subYears(10)->format('Y-m-d') . '|after_or_equal:' . Carbon::now()->subYears(18)->format('Y-m-d'),
            'alamat' => 'required|max:255',
            'no_hp' => 'required|numeric',
            'kelas' => 'exists:kelas,id',
            'wali' => 'required',
            'tahun_ajaran' => 'exists:tapel,id',
            'foto' => 'image|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        $image = $request->file('foto');

        if ($image == null) {
            $inputs['foto'] = 'default_user.png';
        } else {
            $imageName = $inputs['nama'] . time() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/', $imageName);
            $inputs['foto'] = $imageName;
        }

        //update data
        $siswa = $siswa->create($inputs);

        return redirect()->route('siswa')->with('status', 'Data berhasil tambahkan!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }

    public function edit(siswa $id)
    {
        $pages = 'siswa';

        $u = DB::table('siswa')->where('id', $id->id)->get();

        $tapel = DB::table('tapel')->get();
        $kelas = DB::table('kelas')->get();

        $t1 = DB::table('tapel')->where('id', $id->tahun_ajaran)->get();
        $k1 = DB::table('kelas')->where('id', $id->kelas)->get();

        return view('pages.admin.siswa.edit', compact('pages', 'id', 'tapel', 'kelas', 't1', 'k1', 'u'));
    }
    public function update(Siswa $id, Request $request)
    {
        $inputs = $request->all();

        // dd($inputs);
        $request->validate([
            'no_induk' => 'required|size:10',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date|before_or_equal:' . Carbon::now()->subYears(10)->format('Y-m-d') . '|after_or_equal:' . Carbon::now()->subYears(18)->format('Y-m-d'),
            'alamat' => 'required|max:255',
            'wali' => 'required',
            'no_hp' => 'required|numeric',
            'foto' => 'image|mimes:pdf,jpeg,png,jpg',
        ]);

        $image = $request->file('foto');

        if ($image == null) {
            $inputs['foto'] = $id->foto;
        } elseif (!empty($id->foto) && file_exists('uploads/' . $id->foto)) {
            unlink('uploads/' . $id->foto);
        } else {
            $imageName = $inputs['nama'] . time() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/', $imageName);
            $inputs['foto'] = $imageName;
        }

        //update data
        $siswa = $id->update($inputs);

        return redirect()->route('siswa')->with('status', 'Data berhasil diubah!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }


    public function destroy(siswa $id)
    {

        siswa::destroy($id->id);
        return redirect()->route('siswa')->with('status', 'Data berhasil dihapus!')->with('tipe', 'warning')->with('icon', 'fas fa-feather');
    }

    public function multidel(Request $request)
    {

        $ids = $request->ids;
        siswa::whereIn('id', $ids)->delete();

        // load ulang
        #WAJIB
        $pages = 'siswa';
        $datas = siswa::with('users');
        return view('pages.admin.siswa.index', compact('datas', 'request', 'pages'));
    }

    public function cetakPDF(Request $request)
    {
        $pages = 'siswa';
        $tahuns = tapel::all();

        return view('pages.admin.siswa.indexCetak', compact('request', 'tahuns', 'pages'));
    }

    public function cariPDF(Request $request)
    {
        $pages = 'siswa';

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
            return view('pages.admin.siswa.indexCetak', compact('kelases', 'pages', 'request', 'tahuns', 'jml', 're_tapel'));
        } else {
            return view('pages.admin.siswa.notAvailable', compact('pages', 'tahun'));
        }
    }

    public function cetakKelasPDF($tapel, $kelas)
    {
        $siswa = Siswa::where('tahun_ajaran', $tapel)
            ->where('kelas', $kelas)
            ->orderBy('nama', 'asc')
            ->get();

        $kelases = kelas::where('id', $kelas)->first();
        $tahun = tapel::where('id', $tapel)->first();

        $jml = Siswa::where('tahun_ajaran', $tapel)
            ->where('kelas', $kelas)
            ->select('kelas', DB::raw('COUNT(*) as total_siswa'))
            ->groupBy('kelas')
            ->first();

        $namaPdf = 'Data Siswa Kelas-' . $kelases->tigkatan . '' . $kelases->jurusan;

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'pages.admin.siswa.cetakPDF',
            compact('siswa', 'kelases', 'tahun', 'jml')
        );

        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream($namaPdf . '.pdf');
    }

    public function import()
    {
        $pages = 'siswa';
        return view('pages.admin.siswa.import', compact('pages'));
    }


    public function siswaImportExcel(Request $request)
    {
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $file->move('DataSiswa', $namaFile);

        Excel::import(new SiswaImport, public_path('/DataSiswa/' . $namaFile));

        return redirect()->route('siswa');
    }
}
