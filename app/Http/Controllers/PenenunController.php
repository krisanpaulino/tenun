<?php

namespace App\Http\Controllers;

use App\Models\Penenun;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PenenunController extends Controller
{
    function index()
    {
        $title = 'Data Penenun';
        $penenun = Penenun::all();
        return view('backend.penenun', compact('penenun', 'title'));
    }
    function update(Request $request): RedirectResponse
    {

        //Validasi
        $validated = $request->validate([
            'penenun_id' => 'required',
            'nama_penenun' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
            'lokasi' => 'required'
        ]);
        $penenun_id = $request->penenun_id;
        $penenun = Penenun::find($penenun_id);
        $penenun->update($validated);


        return back()->with('message',  'successToast("Data penenun berhasil diubah!")');
    }

    function insert(Request $request): RedirectResponse
    {

        //Validasi
        $validated = $request->validate([
            'nama_penenun' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
            'lokasi' => 'required'
        ]);
        // dd($validated);

        Penenun::insert($validated);

        return back()->with('message', 'successToast("Data penenun berhasil ditambahkan!")');
    }

    function delete(Request $request)
    {
        $penenun_id = $request->penenun_id;
        Penenun::destroy($penenun_id);
        return back()->with('success', 'Data petani berhasil dihapus')->with('message', 'successToast("Data petani berhasil dihapus")');
    }
}
