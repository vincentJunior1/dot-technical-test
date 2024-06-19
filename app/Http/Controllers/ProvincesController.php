<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ProvincesController extends Controller
{
    //
    public function getProvince(Request $request,$id) 
    {
        $data = [];

        if ($request->query('direct') == 'true') {
            $data = $this->getProvinceDirect($id);
        } else {
            $data = Province::where("province_id", $id)->get();
        }


        return response()->json(['data' => $data], 200);
    }

    public function getProvinceDirect($id)
    {
        $rajaOngkirSetup = Http::withHeaders([
            'key' => env('RAJA_ONGKIR_KEY', '')
        ]);
        $url = 'https://api.rajaongkir.com/starter/province';
        $responseProvince = $rajaOngkirSetup->get($url, [
            'id' => $id
        ]);
        $dataProvince = json_decode($responseProvince);
        $newProvince = [
            "province_id" => $dataProvince->rajaongkir->results->province_id,
            "name" => $dataProvince->rajaongkir->results->province,
        ];

        return $newProvince;
    }
}
