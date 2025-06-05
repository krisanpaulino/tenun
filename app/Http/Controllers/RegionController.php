<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Models\Subdistrict;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    function update()
    {
        //Provinsi
        $curl = curl_init();
        //         curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?search=oebufu",
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
        dd($array_response['data']);
        // dd($array_response["rajaongkir"]["results"][0]);
        $provinsi = $array_response["rajaongkir"]["results"];

        foreach ($provinsi as $prov) {
            $dataProv = [
                'province_id' => $prov['province_id'],
                'province' => $prov['province']
            ];
            $pr = new Province();
            $pr->fill($dataProv);
            $pr->save();
        }

        //City
        $curl = curl_init();
        //         curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/city",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 6f236992378c17b751f3b051fbe73779"
            ),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        }
        $array_response = json_decode($response, TRUE);
        // dd($array_response["rajaongkir"]["results"][0]);
        $city = $array_response["rajaongkir"]["results"];

        foreach ($city as $cty) {
            $datacty = [
                'city_id' => $cty['city_id'],
                'province_id' => $cty['province_id'],
                'city' => $cty['city']
            ];
            $ct = new City();
            $ct->fill($datacty);
            $ct->save();
        }
        //City
        $curl = curl_init();
        //         curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 6f236992378c17b751f3b051fbe73779"
            ),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        }
        $array_response = json_decode($response, TRUE);
        // dd($array_response["rajaongkir"]["results"][0]);
        $subdistrict = $array_response["rajaongkir"]["results"];

        foreach ($subdistrict as $sub) {
            $datasub = [
                'subdistrict_id' => $sub['subdistrict_id'],
                'city_id' => $sub['city_id'],
                'subdistrict_name' => $sub['subdistrict_name']
            ];
            $ct = new Subdistrict();
            $ct->fill($datasub);
            $ct->save();
        }
    }
}
