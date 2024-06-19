<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Province;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class FetchDataRajaOngkir extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-data-raja-ongkir';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetching Data Province From Raja Ongkir';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $rajaOngkirSetup = Http::withHeaders([
            'key' => env('RAJA_ONGKIR_KEY', '')
        ]);

        $responseProvince = $rajaOngkirSetup->get('https://api.rajaongkir.com/starter/province');
        $responseCity = $rajaOngkirSetup->get('https://api.rajaongkir.com/starter/city');
        $newProvince = [];
        $newCity = [];
        $dataProvince = json_decode($responseProvince);
        $dataCity = json_decode($responseCity);
        foreach ($dataProvince->rajaongkir->results as $province) {
            $tmp = [
                "province_id" => $province->province_id,
                "name" => $province->province,
            ];
            array_push($newProvince, $tmp);
        }

        foreach ($dataCity->rajaongkir->results as $city) {
            $tmp = [
                "city_id" => $city->city_id,
                "province_id" => $city->province_id,
                "name" => $city->city_name,
                "type" => $city->type,
                "postal_code" => $city->postal_code,
            ];
            array_push($newCity, $tmp);
        }
        DB::table('provinces')->insert($newProvince);
        DB::table('cities')->insert($newCity);
        
        $this->info("Success");
        //
    }
}
