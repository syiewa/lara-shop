<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;

class OngkirCtrl extends Controller {

    private function curl_get_content($url, $method = '', $postdata = '') {
        $curl = curl_init();
        if ($method == 'POST') {
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $postdata,
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded",
                    "key: " . shipOption('rajaongkir_key')
                ),
            ));
        } else {
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "key: " . shipOption('rajaongkir_key')
                ),
            ));
        }

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getProvince($id = null) {
        //
        $data = $this->curl_get_content('http://rajaongkir.com/api/starter/province?id=' . $id);
        $data = json_decode($data, true);
        $this->data['province'] = $data['rajaongkir']['results'];
        return view('front.eshopper.widget.provinsi', $this->data);
    }

    public function getKota($provinceId = '') {
        $data = $this->curl_get_content('http://rajaongkir.com/api/starter/city?&province=' . $provinceId);
        $city = json_decode($data, true);
        $this->data['city'] = $city['rajaongkir']['results'];
        return view('front.eshopper.widget.kota', $this->data);
    }

    public function getCity($cityId = '', $provinceId = '') {
        $data = $this->curl_get_content('http://rajaongkir.com/api/starter/city?id=' . $cityId . '&province=' . $provinceId);
        $city = json_decode($data, true);
        if($cityId != ''){
            return $city['rajaongkir']['results']['city_name'];
        }
        $lookup = [];
        foreach ($city['rajaongkir']['results'] as $result) {
            $lookup[] = ['value' => $result['city_name'], 'data' => $result['city_id']];
        }
        return response()->json($lookup);
    }

    public function postTariff() {
        $input = '';
        $input = Request::get('data');
        $data = $this->curl_get_content('http://rajaongkir.com/api/starter/cost', 'POST', $input);
        $data = json_decode($data, true);
        if ($data['rajaongkir']['status']['code'] == '200') {
            $this->data['destination'] = $data['rajaongkir']['destination_details'];
            $this->data['tariff'] = $data['rajaongkir']['results'];
        }
        return view('front.eshopper.widget.tariff', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
