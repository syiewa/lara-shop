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
                    "key: c32c3ab9158c2a7d8558d7787c2ca919"
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
                    "key: c32c3ab9158c2a7d8558d7787c2ca919"
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
    public function getProvince($id = '') {
        //
        $data = $this->curl_get_content('http://rajaongkir.com/api/starter/province?id=' . $id);
        return $data;
    }

    public function getCity($provinceId = '', $cityId = '') {
        $data = $this->curl_get_content('http://rajaongkir.com/api/starter/city?id=' . $cityId . '&province=' . $provinceId);
        $city = json_decode($data, true);
        $lookup = [];
        foreach($city['rajaongkir']['results'] as $result){
            $lookup[] = ['value' => $result['city_name'],'data' => $result['city_id']];
        }
        return response()->json($lookup);
    }

    public function postTariff() {
        $input = '';
        $input = Request::get('data');
        $data = $this->curl_get_content('http://rajaongkir.com/api/starter/cost', 'POST',$input);
        $data = json_decode($data,true);
        $this->data['tariff'] = $data['rajaongkir']['results'];
        return view('front.eshopper.widget.tariff',$this->data);
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
