<?php

namespace App\Http\Controllers;

use App\Models\Detailpembelian;
use App\Models\Detailtransaksi;
use App\Models\Keranjang;
use App\Models\LogPengiriman;
use App\Models\Metodepembayaran;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Pembelian;
use App\Models\Pengiriman;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Nette\Utils\Helpers;

class TransaksiController extends Controller
{
    protected $user;
    function __construct()
    {
        // $this->user = User::where('username', Session::get('email'))->first();;
    }
    function needVerify()
    {
        $title = 'Butuh Verifikasi';

        $transaksi = Transaksi::join('pembayaran', 'pembayaran.transaksi_id', '=', 'transaksi.transaksi_id')
            ->where('pembayaran.status_pembayaran', '=', 'verifikasi')
            ->where('status_transaksi', '=', 'checkout')->get();
        return view('backend.transaksi', compact('transaksi', 'title'));
    }
    function verifikasi(Request $request)
    {
        $transaksi_id = $request->transaksi_id;
        $transaksi = Transaksi::find($transaksi_id);
        $transaksi->status_transaksi = 'proses';
        $transaksi->update();

        $pengiriman =  Pengiriman::where('transaksi_id', '=', $transaksi_id)->first();
        $pengiriman->update(['status_pengiriman' => 'dikemas']);

        $logPengiriman = [
            'pengiriman_id' => $pengiriman->pengiriman_id,
            'status_pengiriman' => 'dikemas',
            'keterangan' => '-'
        ];

        LogPengiriman::insert($logPengiriman);

        $pembayaran =  Pembayaran::where('transaksi_id', '=', $transaksi_id)->first();
        $pembayaran->update(['status_pembayaran' => 'valid']);

        return back()->with('message', 'succesToast("Berhasil Verifikasi! Segera proses pengiriman!")');
    }
    function needShipping()
    {
        $title = 'Butuh Pengiriman';

        $transaksi = Transaksi::join('pengiriman', 'pengiriman.transaksi_id', '=', 'transaksi.transaksi_id')->where('pengiriman.status_pengiriman', '=', 'dikemas')->get();
        // dd($transaksi);
        return view('backend.transaksi', compact('transaksi', 'title'));
    }

    function kirim(Request $request): RedirectResponse
    {
        $transaksi_id = $request->transaksi_id;
        $pengiriman =  Pengiriman::where('transaksi_id', '=', $transaksi_id)->first();
        $pengiriman->status_pengiriman = 'dikirim';
        $pengiriman->resi = $request->resi;
        $pengiriman->save();

        $logPengiriman = [
            'pengiriman_id' => $pengiriman->pengiriman_id,
            'status_pengiriman' => 'dikirim',
            'keterangan' => '-'
        ];
        LogPengiriman::insert($logPengiriman);

        return back()->with('message', 'succesToast("Berhasil proses pengiriman")');
    }

    function onShipping()
    {
        $title = 'Dalam Proses Pengiriman';

        $transaksi = Transaksi::join('pengiriman', 'pengiriman.transaksi_id', '=', 'transaksi.transaksi_id')->where('pengiriman.status_pengiriman', '=', 'dikirim')->get();
        // dd($transaksi);
        return view('backend.transaksi', compact('transaksi', 'title'));
    }
    function finished()
    {
        $title = 'Selesai';

        $transaksi = Transaksi::where('status_transaksi', 'selesai')->get();
        // dd($transaksi);
        return view('backend.transaksi', compact('transaksi', 'title'));
    }

    function finishing(Request $request): RedirectResponse
    {
        $transaksi_id = $request->transaksi_id;
        $transaksi = Transaksi::find($transaksi_id);
        $pengiriman =  Pengiriman::where('transaksi_id', '=', $transaksi_id)->first();
        $pengiriman->status_pengiriman = 'sampai';
        $pengiriman->save();

        $logPengiriman = [
            'pengiriman_id' => $pengiriman->pengiriman_id,
            'status_pengiriman' => 'sampai',
            'keterangan' => '-'
        ];
        LogPengiriman::insert($logPengiriman);

        $transaksi->update(['status_transaksi' => 'selesai']);

        return back()->with('message', 'succesToast("Berhasil proses pengiriman")');
        // array_find($logPengiriman, fun)
    }

    function order()
    {
        $title = 'Order';

        if ($this->user->user_type == 'admin')
            $pembelian = Pembelian::get();
        else
            $pembelian = Pembelian::join('detailpembelian', 'detailpembelian.pembelian_id', '=', 'pembelian.pembelian_id')
                ->join('produk', 'detailpembelian.produk_id', '=', 'produk.produk_id')
                ->where('status_pembelian', '!=', 'menunggu pembayaran')
                ->where('status_pembelian', '!=', 'verifikasi pembayaran')
                ->where('petani_id', '=', $this->user->petani->petani_id)
                ->groupBy('pembelian.pembelian_id')
                ->get();
        // dd($pembelian);
        return view('backend.order-masuk', compact('pembelian', 'title'));
    }

    function detailTransaksi($id)
    {
        $title = 'Detail Order';
        $transaksi = Transaksi::find($id);
        $pelanggan = Pelanggan::find($transaksi->pelanggan_id);
        return view('backend.transaksi-detail', compact('transaksi', 'pelanggan', 'title'));
    }
    function detailAdmin($id)
    {
        $title = 'Detail Order';
        $pembelian = Pembelian::find($id);
        $detail = $pembelian->detailpembelian;
        // $detail = Detailpembelian::join('produk', 'detailpembelian.produk_id', '=', 'produk.produk_id')
        //     ->where('pembelian_id', '=', $id)->get();
        // dd($detail);
        $ongkir = new Pengiriman();
        $ongkir->biaya = $pembelian->ongkir;
        $total = $pembelian->ongkir + $pembelian->total_bayar;
        return view('backend.order-detail', compact('pembelian', 'detail', 'ongkir', 'total', 'title'));
    }
    function diproses()
    {
        $title = 'Order Diproses';

        if ($this->user->user_type == 'admin')
            $pembelian = Pembelian::where('status_pembelian', '=', 'diproses')->get();
        else
            $pembelian = Pembelian::join('detailpembelian', 'detailpembelian.pembelian_id', '=', 'pembelian.pembelian_id')
                ->join('produk', 'detailpembelian.produk_id', '=', 'produk.produk_id')
                ->join('pengiriman', 'pengiriman.pembelian_id', '=', 'pembelian.pembelian_id')
                // ->where('status_pembelian', '=', 'diproses')
                ->where('produk.petani_id', '=', $this->user->petani->petani_id)
                ->where('status_pengiriman', '=', 'dikirim')
                ->groupBy('pembelian.pembelian_id')
                ->get();
        // dd($pembelian);
        return view('backend.order-masuk', compact('pembelian', 'title'));
    }
    function selesai()
    {
        $title = 'Order Selesai';

        if ($this->user->user_type == 'admin')
            $pembelian = Pembelian::where('status_pembelian', '=', 'selesai')->get();
        else
            $pembelian = Pembelian::join('detailpembelian', 'detailpembelian.pembelian_id', '=', 'pembelian.pembelian_id')
                ->join('produk', 'detailpembelian.produk_id', '=', 'produk.produk_id')
                ->join('pengiriman', 'pengiriman.pembelian_id', '=', 'pembelian.pembelian_id')
                // ->where('status_pembelian', '=', 'diproses')
                ->where('produk.petani_id', '=', $this->user->petani->petani_id)
                ->where('status_pengiriman', '=', 'selesai')
                ->groupBy('pembelian.pembelian_id')
                ->get();
        // dd($pembelian);
        return view('backend.order-masuk', compact('pembelian', 'title'));
    }


    function prosesPost(Request $request)
    {
        $pembelian_id = $request->pembelian_id;
        $pembelian = Pembelian::find($pembelian_id);
        $pembelian->status_pembelian = 'diproses';
        $pembelian->update();

        Pengiriman::where('pembelian_id', '=', $pembelian_id)->update(['status_pengiriman' => 'dikemas']);
        return back()->with('message', 'succesToast("Berhasil proses pengiriman")');
    }
    function selesaiPost(Request $request)
    {
        $pembelian_id = $request->pembelian_id;
        $pengiriman =  Pengiriman::where('petani_id', '=', $this->user->petani->petani_id)
            ->where('pembelian_id', '=', $pembelian_id)
            ->first();

        $pengiriman->status_pengiriman = 'selesai';
        $pengiriman->resi = $request->resi;
        $pengiriman->estimasi = $request->estimasi;
        $pengiriman->update();

        if (!Pengiriman::where('pembelian_id', '=', $pembelian_id)->where('status_pengiriman', '=', 'dikirim')->exists()) {
            $pembelian = Pembelian::find($pembelian_id);
            $pembelian->status_pembelian = 'selesai';
            $pembelian->update();
        }
        return back()->with('message', 'succesToast("Berhasil proses selesai")');
    }

    //Pelanggan
    function cartPost(Request $request): RedirectResponse
    {
        // $cart =
        if (Session::get('type') != 'pelanggan')
            return redirect(route('login'));
        //Validasi
        $validated = $request->validate([
            'produk_id' => 'required',
            'kuantitas' => 'required'
        ]);
        $user_id = Session::get('user_id');
        $pelanggan = Pelanggan::where('user_id', $user_id)->first();
        $validated['pelanggan_id'] = $pelanggan->pelanggan_id;
        //Cek Stok
        if (!Produk::where('produk_id', "=", $validated['produk_id'])->where('stok_produk', '>=', $validated['kuantitas'])->exists()) {
            return back()->with('message', "dangerToast('Pesanan tidak boleh melebihi stok');");
        }

        Keranjang::insert($validated);

        return back()->with('message', 'successToast("Produk ditambahkan ke keranjang!")');
    }
    function checkout(Request $request)
    {
        $title = 'Checkout';
        $pelanggan = Pelanggan::where('user_id', '=', Session::get('user_id'))->first();
        $keranjang = Keranjang::where('pelanggan_id', '=', $pelanggan->pelanggan_id)->where('checkout', '=', '0')->get();
        $metode = Metodepembayaran::all();
        $total = 0;
        foreach ($keranjang as $cart) {
            if (!Produk::where('produk_id', "=", $cart->produk_id)->where('stok_produk', '>=', $cart->kuantitas)->exists()) {
                return back()->with('message', "dangerToast('Pesanan tidak boleh melebihi stok');");
            }
            $produk = Produk::find($cart->produk_id);
            $total += $produk->harga_produk;
        }
        // // dd($pembeli);
        // $curl = curl_init();
        // //         curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
        // // curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 30,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     CURLOPT_POSTFIELDS => "origin=213&destination=$pelanggan->kota&weight=1&courier=jne",
        //     CURLOPT_HTTPHEADER => array(
        //         "content-type: application/x-www-form-urlencoded",
        //         "key: 78861dcc740d4ea5ba1c732fe9183da0"
        //     ),
        //     CURLOPT_SSL_VERIFYPEER => false,
        //     CURLOPT_SSL_VERIFYHOST => false
        // ));
        // $response = curl_exec($curl);
        // $err = curl_error($curl);
        // curl_close($curl);
        // if ($err) {
        //     echo "cURL Error #:" . $err;
        // }
        // $array_response = json_decode($response, TRUE);
        // // dd($array_response["rajaongkir"]["results"][0]);
        // $ongkir = $array_response["rajaongkir"]["results"][0];
        return view('frontend.checkout', compact('keranjang', 'title', 'pelanggan', 'metode', 'total'));
    }

    function placeOrder(Request $request): RedirectResponse
    {

        // dd($request->all());
        $pelanggan = Pelanggan::where('user_id', '=', Session::get('user_id'))->first();
        $keranjang = Keranjang::where('pelanggan_id', '=', $pelanggan->pelanggan_id)->where('checkout', '=', '0')->get();
        $status_pembayaran = 'menunggu pembayaran';
        $status_transaksi = 'checkout';
        $status_pengiriman = 'pending';
        if ($request->metode_id == 2) {
            $status_pembayaran = 'pending';
            $status_transaksi = 'proses';
            $status_pengiriman = 'dikemas';
        }
        $datatrx = [
            'pelanggan_id' => $pelanggan->pelanggan_id,
            'status_transaksi' => $status_transaksi,
            'total_produk' => $request->subtotal,
            'total_ongkir' => $request->ongkir,
            'grand_total' => $request->subtotal + $request->ongkir,
            'alamat_transaksi' => $request->alamat_transaksi,
            'lokasi_id' => $request->lokasi_id,
            'alamat_region' => $request->alamat_region,
        ];
        $transaksi = new Transaksi();
        $transaksi->fill($datatrx);
        $transaksi->save();

        foreach ($keranjang as $cart) {
            $data = [
                'transaksi_id' => $transaksi->transaksi_id,
                'produk_id' => $cart->produk_id,
                'kuantitas' => $cart->kuantitas,
                'diskon' => '0',
                'sub_total' => $cart->kuantitas * $cart->produk->harga_produk
            ];
            Detailtransaksi::insert($data);

            $cart->update(['checkout' => '1']);
            // dd($cart->checkout);
            $produk = Produk::find($cart->produk_id);
            $produk->decrement('stok_produk', $cart->kuantitas);
        }

        $ongkir = $request->ongkir;
        $pengiriman = [
            'transaksi_id' => $transaksi->transaksi_id,
            'ongkos_kirim' => $ongkir,
            'cara_kirim' => 'kurir',
            'status_pengiriman' => $status_pengiriman
        ];
        Pengiriman::insert($pengiriman);

        $pembayaran = [
            'transaksi_id' => $transaksi->transaksi_id,
            // 'tanggal_bayar' =>
            'metode_id' => $request->metode_id,
            'status_pembayaran' => $status_pembayaran
        ];
        Pembayaran::insert($pembayaran);

        return redirect(route('order.detail', $transaksi->transaksi_id));
    }

    function uploadBukti(Request $request)
    {
        $transaksi_id = $request->transaksi_id;
        // $transaksi = Transaksi::find($transaksi_id);
        $path = $request->file('bukti_pembayaran')->storePublicly('bukti', 'public');
        $data = [
            'tanggal_bayar' => date('Y-m-d H:i:s'),
            'bukti_pembayaran' => $path,
        ];
        $pembayaran = Pembayaran::where('transaksi_id', '=', $transaksi_id)->first();
        if ($pembayaran == null) {
            $pembayaran = new Pembayaran();
            $pembayaran->fill($data);
            $pembayaran->save();
        } else {
            $pembayaran->update($data);
        }
        $pembayaran->status_pembayaran = 'verifikasi';
        $pembayaran->save();
        return back()->with('message', "successToast('pembayaran diterima, menunggu verifikasi')");
    }
}
