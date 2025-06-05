<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Detailpembelian;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\Pembeli;
use App\Models\Pembelian;
use App\Models\Penenun;
use App\Models\Pengiriman;
use App\Models\Province;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    function index(Request $request)
    {
        $kategoriGet = $request->kategori;
        $keyword = $request->keyword;
        if ($keyword == null)
            $keyword = '';
        if ($kategoriGet == null)
            $kategoriGet = [];
        $kategori = Kategori::all();
        $title = 'Home Page';
        if ($kategoriGet == null)
            $produk = Produk::where('stok_produk', '>', '0')->orderBy('produk_id', 'desc')->where('nama_produk', 'like', '%' . $keyword . '%')->paginate(12);
        else
            $produk = Produk::where('stok_produk', '>', '0')->orderBy('produk_id', 'desc')->where('nama_produk', 'like', '%' . $keyword . '%')->whereIn('kategori_id', $kategoriGet)->paginate(12);

        return view('frontend.home', compact('title', 'produk', 'kategori', 'kategoriGet', 'keyword'));
    }

    function search(Request $request)
    {
        $title = 'Search';
        $keyword = $request->keyword;
        $produk = Produk::where('nama_produk', 'LIKE', "%{$keyword}%")->orderBy('produk_id', 'desc')->paginate(12);
        return view('frontend.home', compact('title', 'produk', 'keyword'));
    }

    function orderPost(Request $request): RedirectResponse
    {
        // $cart =
        //Validasi
        $validated = $request->validate([
            'produk_id' => 'required',
            'jumlah_beli' => 'required'
        ]);

        //Cek Stok
        if (!Produk::where('produk_id', "=", $validated['produk_id'])->where('stok', '>=', $validated['jumlah_beli'])->exists()) {
            return back()->with('message', "dangerToast('Pesanan tidak boleh melebihi stok');");
        }

        $produk = Produk::find($validated['produk_id']);
        // $produk->decrement('stok', $validated['jumlah_beli']);
        // Petani::insert($validated);

        $pembeli = Pembeli::where('user_id', '=', Session::get('user_id'))->first();

        $totalbayar = $produk->harga * $validated['jumlah_beli'];
        $data['pembeli_id'] = $pembeli->pembeli_id;

        $pembelian = Pembelian::where('pembeli_id', '=', $data['pembeli_id'])->where('status_pembelian', '=', 'in cart')->first();

        if ($pembelian) {
            $pembelian->increment('total_bayar', $totalbayar);
            $pembelian->update($data);
        } else {
            $data['status_pembelian'] = 'in cart';
            $data['total_bayar'] = $totalbayar;
            $pembelian = new Pembelian();
            $pembelian->fill($data);
            $pembelian->save();
        }
        $validated['pembelian_id'] = $pembelian->pembelian_id;
        $validated['harga_detail'] = $totalbayar;
        Detailpembelian::insert($validated);

        return back();
    }

    function cart()
    {
        $title = 'Keranjang';
        $pelanggan = Pelanggan::where('user_id', '=', Session::get('user_id'))->first();
        $keranjang = Keranjang::where('pelanggan_id', '=', $pelanggan->pelanggan_id)->where('checkout', '=', '0')->get();
        // dd($pembeli);

        return view('frontend.cart', compact('keranjang', 'title'));
    }
    function deleteCart(Request $request): RedirectResponse
    {
        // $pembeli = Pembeli::where('user_id', '=', Session::get('user_id'))->first();
        Keranjang::destroy($request->keranjang_id);
        return back();
    }

    function detailOrder($transaksi_id)
    {
        $pelanggan = Pelanggan::where('user_id', '=', Session::get('user_id'))->first();
        $transaksi = Transaksi::find($transaksi_id);
        $pembayaran = Pembayaran::where('transaksi_id', '=', $transaksi->transaksi_id)->first();
        // dd(json_encode($transaksi->pembayaran));

        return view('frontend.orderdetail', compact('transaksi', 'pelanggan', 'pembayaran'));
    }



    function listOrder()
    {

        $pelanggan = Pelanggan::where('user_id', '=', Session::get('user_id'))->first();
        $transaksi = Transaksi::where('pelanggan_id', $pelanggan->pelanggan_id)->orderBy('tanggal_transaksi', 'desc')->get();

        return view('frontend.orderlist', compact('transaksi', 'pelanggan'));
    }
    function profil()
    {
        $title = 'Profil';
        $user = User::find(Session::get('user_id'));
        $provinsi = Province::get();
        $kota = City::get();

        return view('frontend.profil', compact('user', 'title', 'provinsi', 'kota'));
    }

    function lokasiPenenun($penenun_id)
    {
        $penenun = Penenun::find($penenun_id);
        $title = 'Penenun';

        return view('frontend.penenun', compact('penenun', 'title'));
    }
}
