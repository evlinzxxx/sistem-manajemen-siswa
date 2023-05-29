<?php

namespace App\Http\Controllers;

use App\Models\tapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class admintapelcontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages = 'tapel';
        $datas = tapel::paginate(15);

        return view('pages.admin.tapel.index', compact('datas', 'request', 'pages'));
    }
    public function cari(Request $request)
    {
        $cari = $request->cari;
        #WAJIB
        $pages = 'tapel';
        $datas = Tapel::where('tahun_ajaran', 'like', "%" . $cari . "%")->paginate(15);

        return view('pages.admin.tapel.index', compact('datas', 'request', 'pages'));
    }
    public function create()
    {
        $pages = 'tapel';

        return view('pages.admin.tapel.create', compact('pages'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $tapel = Tapel::create($data);
        return redirect()->route('tapel')->with('status', 'Data berhasil tambahkan!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }

    public function edit(tapel $id)
    {
        $pages = 'tapel';

        return view('pages.admin.tapel.edit', compact('pages', 'id'));
    }
    public function update(tapel $id, Request $request)
    {
        $data = $request->all();

        $tapel = $id->update($data);

        return redirect()->route('tapel')->with('status', 'Data berhasil diubah!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }
    public function destroy(tapel $id)
    {

        tapel::destroy($id->id);
        return redirect()->route('tapel')->with('status', 'Data berhasil dihapus!')->with('tipe', 'warning')->with('icon', 'fas fa-feather');
    }

    public function multidel(Request $request)
    {

        $ids = $request->ids;
        tapel::whereIn('id', $ids)->delete();

        // load ulang
        #WAJIB
        $pages = 'tapel';
        $datas = DB::table('tapel');

        return view('pages.admin.tapel.index', compact('datas', 'request', 'pages'));
    }
}
