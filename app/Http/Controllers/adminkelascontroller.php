<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;

class adminkelascontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages = 'kelas';
        $datas = Kelas::paginate(15);

        return view('pages.admin.kelas.index', compact('request', 'pages','datas'));
    }
    public function cari(Request $request)
    {

        $cari = $request->cari;
        #WAJIB
        $pages = 'kelas';
        $datas = kelas::where('tingkatan', 'like', "%" . $cari . "%")
            ->orWhere('jurusan', 'like', "%" . $cari . "%")->paginate(15);

        return view('pages.admin.kelas.index', compact('datas', 'request', 'pages'));
    }
    public function create()
    {
        $pages = 'kelas';
        return view('pages.admin.kelas.create', compact('pages'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $kelass = Kelas::create($data);

        return redirect()->route('kelas')->with('status', 'Data berhasil tambahkan!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }

    public function edit(kelas $id)
    {
        $pages = 'kelas';
        $kelases = Kelas::all();
        
        return view('pages.admin.kelas.edit', compact('pages', 'id', 'kelases'));
    }
    public function update(kelas $id, Request $request)
    {

        $data = $request->all();

        $kelas = $id->update($data);

        return redirect()->route('kelas')->with('status', 'Data berhasil diubah!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }
    public function destroy(kelas $id)
    {

        kelas::destroy($id->id);
        return redirect()->route('kelas')->with('status', 'Data berhasil dihapus!')->with('tipe', 'warning')->with('icon', 'fas fa-feather');
    }

    public function multidel(Request $request)
    {

        $ids = $request->ids;
        kelas::whereIn('id', $ids)->delete();

        // load ulang
        #WAJIB
        $pages = 'kelas';
        // dd($datas);

        return view('pages.admin.kelas.index', compact('request', 'pages'));
    }
}
