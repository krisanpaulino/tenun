<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    function admin()
    {
        $masuk = Transaksi::where('status_transaksi', '=', 'checkout')->count('transaksi.transaksi_id');
        // dd($transaksi);
        //Total pesanan diproses
        $proses = Transaksi::join('pengiriman', 'pengiriman.transaksi_id', '=', 'transaksi.transaksi_id')->where('pengiriman.status_pengiriman', '=', 'dikirim')->count('transaksi.transaksi_id');
        //Total pesanan selesai
        $kirim = Transaksi::join('pengiriman', 'pengiriman.transaksi_id', '=', 'transaksi.transaksi_id')->where('pengiriman.status_pengiriman', '=', 'dikemas')->count('transaksi.transaksi_id');
        $selesai = Transaksi::where('status_transaksi', 'selesai')->count('transaksi.transaksi_id');
        $kategori = Kategori::all();

        $title = 'Dashboard Admin';
        return view('backend.dashboard', compact('title', 'masuk', 'proses', 'kirim', 'selesai', 'kategori'));
    }

    function gantiPassword()
    {
        $title = 'Ganti Password';
        return view('backend.ganti-password', compact('title'));
    }
}
