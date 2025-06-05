<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Penenun;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProdukController extends Controller
{
    function index()
    {
        $title = 'Data Produk';
        // $user = User::where('username', Session::get('email'))->first();

        $produk = Produk::orderBy('produk_id', 'desc')->get();
        return view('backend.produk_index', compact('produk', 'title'));
    }

    function kategori()
    {
        $title = 'Data Kategori';
        $kategori = Kategori::all();
        return view('backend.kategori', compact('kategori', 'title'));
    }

    function insertKategori(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kategori' => 'required',
        ]);

        Kategori::insert($validated);

        return back()->with('message', 'successToast("Kategori berhasil ditambahkan")');
    }
    function deleteKategori(Request $request)
    {
        $kategori_id = $request->kategori_id;
        Kategori::destroy($kategori_id);
        return back()->with('success', 'Data kategori berhasil dihapus')->with('message', 'successToast("Data kategori berhasil dihapus")');
    }
    function updateKategori(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kategori_id' => 'required',
            'nama_kategori' => 'required',
        ]);
        $kategori_id = $request->kategori_id;
        $kategori = Kategori::find($kategori_id);
        $kategori->update($validated);

        return back()->with('message', 'successToast("Kategori berhasil diubah")');
    }

    function tambah()
    {
        $penenun = Penenun::orderBy('nama_penenun')->get();
        $kategori = Kategori::all();
        $title = 'Tambah Produk';
        return view('backend.produk_tambah', compact('title', 'kategori', 'penenun'));
    }
    function edit($id)
    {
        $produk = Produk::find($id);
        $kategori = Kategori::all();
        $penenun = Penenun::orderBy('nama_penenun')->get();
        $title = 'Edit Produk';
        return view('backend.produk_edit', compact('title', 'produk', 'kategori', 'penenun'));
    }
    function insert(Request $request): RedirectResponse
    {
        //Validasi
        $validated = $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'deskripsi_produk' => 'required',
            'stok_produk' => 'required',
            'kategori_id' => 'required',
            'penenun_id' => 'required',
            'gambar_produk' => 'required',
        ]);
        $path = $request->file('gambar_produk')->storePublicly('produk', 'public');
        // dd($path);
        $validated['gambar_produk'] = $path;


        Produk::insert($validated);

        return redirect(route('produk.index'))->with('message', 'successToast("Produk ditambahkan")');
    }
    function update(Request $request): RedirectResponse
    {
        $produk_id = $request->produk_id;
        //Validasi
        $validated = $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'deskripsi_produk' => 'required',
            'stok_produk' => 'required',
            'kategori_id' => 'required',
            'penenun_id' => 'required',
        ]);
        if ($request->file('gambar_produk') != null) {
            $path = $request->file('gambar_produk')->storePublicly('produk', 'public');
            $validated['gambar_produk'] = $path;
        }


        $produk = Produk::find($produk_id);
        $produk->update($validated);

        return redirect(route('produk.index'));
    }
    function updateStok(Request $request)
    {
        $produk_id = $request->produk_id;
        $produk = Produk::find($produk_id);
        $stok = $request->stok;
        $produk->increment('stok', $stok);
        return redirect(route('produk.index'));
    }

    function delete(Request $request)
    {
        $produk_id = $request->produk_id;
        Produk::destroy($produk_id);
        return back()->with('success', 'Data produk berhasil dihapus')->with('message', 'successToast("Data produk berhasil dihapus")');
    }

    //Untuk Admin
    function tersedia()
    {
        $title = 'Produk Tersedia';
        $produk = Produk::where('stok', '>', '0')->get();

        return view('backend.produk_tersedia', compact('title', 'produk'));
    }

    function byPenenun($penenun_id)
    {
        $penenun = Penenun::find($penenun_id);
        $produk = Produk::where('penenun_id', '=', $penenun_id)->get();
        $title = 'Produk Penenun';

        return view('backend.produk_penenun', compact('title', 'produk', 'penenun'));
    }
}
