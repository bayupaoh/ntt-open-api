<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VaksinController extends Controller
{
    public function getCity(Request $request) {
        return response()->json([
            "status" => 200,
            "message" => "Success",
            "data" => [
                "KAB. KUPANG",
                "KAB. NAGEKEO",
                "KAB. MANGGARAI BARAT",
                "KAB TIMOR TENGAH SELATAN",
                "KAB. LEMBATA",
                "KAB. TIMOR TENGAH UTARA",
                "KAB. MALAKA",
                "KAB. ENDE",
                "KAB. NGADA",
                "KOTA KUPANG",
                "KAB. BELU",
                "KAB. SUMBA BARAT DAYA",
                "KAB. SUMBA TENGAH",
                "KAB. MANGGARAI TIMUR",
                "KAB. FLORES TIMUR",
                "KAB. ALOR",
                "KAB. SIKKA",
                "KAB. SUMBA TIMUR",
                "KAB. SUMBA BARAT",
                "KAB. SABU RAIJUA",
                "KAB. ROTE NDAO"
            ]
        ], 200);
    }

    public function getVaccineLocation(Request $request) {
        $city = $request->city;
        $url = 'https://kipi.covid19.go.id/api/get-faskes-vaksinasi?city='.$city;
        $response = Http::get($url);
        return response()->json($response->json(), 200);
    }
}