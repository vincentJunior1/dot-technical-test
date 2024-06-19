<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvincesController extends Controller
{
    //
    public function getProvince($id) 
    {
        $data = Province::where("province_id", $id)->get();

        return response()->json(['data' => $data], 200);
    }
}
