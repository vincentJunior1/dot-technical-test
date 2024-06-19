<?php

namespace App\Http\Controllers;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class CitiesController extends Controller
{
    //
    public function getCities(Request $request,$id) 
    {
        $data = [];
        if ($request->query('direct') == 'true') {
            $data = $this->getCityDirect($id);
        } else {
            $data = City::where('city_id',$id)->get();
        }

        return response()->json(['data' => $data], 200);
    }

    public function getCityDirect($id)
    {
        $rajaOngkirSetup = Http::withHeaders([
            'key' => env('RAJA_ONGKIR_KEY', '')
        ]);
        $url = 'https://api.rajaongkir.com/starter/city';
        $responseCity = $rajaOngkirSetup->get($url, [
            'id' => $id
        ]);
        $dataCity = json_decode($responseCity);
        $newCity = [
            "city_id" => $dataCity->rajaongkir->results->city_id,
            "province_id" => $dataCity->rajaongkir->results->province_id,
            "name" => $dataCity->rajaongkir->results->city_name,
            "type" => $dataCity->rajaongkir->results->type,
            "postal_code" => $dataCity->rajaongkir->results->postal_code,
        ];

        return $newCity;
    }
}
