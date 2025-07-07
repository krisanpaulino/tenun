<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{
    function lokasi(Request $request)
    {
        $search = urlencode($request->search);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?search=" . $search,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 6f236992378c17b751f3b051fbe73779"
            )
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        }
        $array_response = json_decode($response, TRUE);
        $result = [];
        foreach ($array_response['data'] as $key => $res) {
            $result[$key] = [
                'id' => $res['id'],
                'text' => $res['label']
            ];
        }
        $data['results'] = $result;
        echo json_encode($data);
    }
    function cost(Request $request)
    {
        $destination = $request->destination;
        $curl = curl_init();
        //         curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_POSTFIELDS => array(
                'origin' => '34462',
                'destination' => $destination,
                'weight' => 1000,
                'courier' => 'lion'
            ),
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "key: 6f236992378c17b751f3b051fbe73779"
            )
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        }
        $array_response = json_decode($response, TRUE);
        // $result = [];
        // foreach ($array_response['data'] as $key => $res) {
        //     $result[$key] = [
        //         'id' => $res['id'],
        //         'text' => $res['label']
        //     ];
        // }
        // $data['results'] = $result;
        echo json_encode($array_response['data']);
    }

    function getMasukUnread()
    {
        $transaksi = Transaksi::where('read', 0)->where('status_transaksi', 'checkout')->get();
        foreach ($transaksi as $trx) {
            $trx->read = 1;
            $trx->save();
        }
        echo json_encode($transaksi);
    }
    function orderMasuk()
    {
        $transaksi = Transaksi::where('status_transaksi', 'checkout')->count();
        echo json_encode($transaksi);
    }
    function getProsesUnread()
    {
        $user = User::where('email', Session::get('email'))->first();;
        $transaksi = Transaksi::where('read', 0)->where('status_transaksi', 'proses')->where('pelanggan_id', $user->pelanggan->pelanggan_id)->get();
        foreach ($transaksi as $trx) {
            $trx->read = 1;
            $trx->save();
        }
        echo json_encode($transaksi);
    }
    function orderProses()
    {
        $user = User::where('email', Session::get('email'))->first();;
        $transaksi = Transaksi::where('status_transaksi', 'proses')->where('pelanggan_id', $user->pelanggan->pelanggan_id)->where('read', 1)->count();
        echo json_encode($transaksi);
    }
}
