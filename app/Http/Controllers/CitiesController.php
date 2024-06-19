<?php

namespace App\Http\Controllers;
use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    //
    public function getCities($id) 
    {
        $id = $request->query('id');
        $data = City::where('city_id',$id)->get();

        return response()->json(['data' => $data], 200);
    }
}
