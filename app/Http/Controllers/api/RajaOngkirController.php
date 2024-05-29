<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{

    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env('API_KEY_RAJA_ONGKIR');
    }

    public function get_provinces()
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey,
        ])->get('https://api.rajaongkir.com/starter/province');
        $data = $response->json();
        $provinces = $data["rajaongkir"]["results"];

        return new ResponseResource(true, 'Detail Provinsi!', $provinces);
    }

    public function get_city(Request $request, $province_id)
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey,
        ])->get('https://api.rajaongkir.com/starter/city?province=' . $province_id);
        $data = $response->json();
        $city = $data["rajaongkir"]["results"];
        return new ResponseResource(true, 'Detail Provinsi!', $city);
    }
    public function check_ongkir(Request $request)
    {

        $data = [
            'origin' => $request->origin,
            'destination' => $request->destination,
            'weight' => $request->weight,
            'courier' => $request->courier,
        ];

        $response = Http::withHeaders([
            'key' => $this->apiKey,
        ])->post('https://api.rajaongkir.com/starter/cost', $data);
        $data = $response->json();
        $ongkir = $data["rajaongkir"]["results"][0];
        return new ResponseResource(true, 'Detail Provinsi!', $ongkir);
    }
}
