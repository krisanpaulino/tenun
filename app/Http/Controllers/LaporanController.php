<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Petani;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    function laporanPage(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $title = 'Laporan';

        // dd($sampai);

        $model = Transaksi::select('*');
        if ($dari != null)
            $model->where(DB::raw('CAST(tanggal_transaksi AS DATE)'), '>=', $dari);
        if ($sampai != null)
            $model->where(DB::raw('CAST(tanggal_transaksi AS DATE)'), '<=', $sampai);
        $laporan = $model->get();


        return view('backend.laporan_transaksi', compact('laporan', 'dari', 'sampai', 'title'));
    }

    function cetak(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $title = 'Laporan';

        // dd($dari);

        $model = Transaksi::select('*');
        if ($dari != null && $dari != '')
            $model->where(DB::raw('CAST(tanggal_transaksi AS DATE)'), '>=', $dari);
        if ($sampai != null && $sampai != '')
            $model->where(DB::raw('CAST(tanggal_transaksi AS DATE)'), '<=', $sampai);
        $laporan = $model->get();
        $data = [
            'title' => 'Laporan Pembelian',
            'tanggal' => date('Y-m-d'),
            'laporan' => $laporan,
            'dari' => $dari,
            'sampai' => $sampai
        ];
        // dd($laporan);
        // return view('backend.laporan_pdf', $data);
        $pdf = Pdf::loadView('backend.laporan_pdf', $data);

        return $pdf->download('laporan-transaksi.pdf');
    }
}
