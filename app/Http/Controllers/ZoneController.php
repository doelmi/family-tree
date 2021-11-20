<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function provinces()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://github.doelmi.id/api-wilayah-indonesia/api/provinces.json');
        if ($response->getStatusCode() != 200) {
            return response()->json([]);
        }
        return response()->json(json_decode((string) $response->getBody()));
    }

    public function cities(Request $request)
    {
        $client = new Client();
        $province_id = $request->input('province_id', '');
        $response = $client->request('GET', "https://github.doelmi.id/api-wilayah-indonesia/api/regencies/$province_id.json");
        if ($response->getStatusCode() != 200) {
            return response()->json([]);
        }
        return response()->json(json_decode((string) $response->getBody()));
    }

    public function districts(Request $request)
    {
        $client = new Client();
        $city_id = $request->input('city_id', '');
        $response = $client->request('GET', "https://github.doelmi.id/api-wilayah-indonesia/api/districts/$city_id.json");
        if ($response->getStatusCode() != 200) {
            return response()->json([]);
        }
        return response()->json(json_decode((string) $response->getBody()));
    }

    public function villages(Request $request)
    {
        $client = new Client();
        $district_id = $request->input('district_id', '');
        $response = $client->request('GET', "https://github.doelmi.id/api-wilayah-indonesia/api/villages/$district_id.json");
        if ($response->getStatusCode() != 200) {
            return response()->json([]);
        }
        return response()->json(json_decode((string) $response->getBody()));
    }
}
