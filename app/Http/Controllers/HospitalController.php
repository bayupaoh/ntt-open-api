<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class HospitalController extends Controller
{
    public function listHospital(Request $request) {                
        $path = storage_path() . "/json/ntt-hospital.json";
        $data = json_decode(file_get_contents($path), true); 
        return response()->json([
            "status" => 200,
            "message" => "Success",
            "data" => $data
        ], 200);
    }

    public function hospitalHumanResources(Request $request) {                
        $client = new Client(HttpClient::create(['timeout' => 60]));
        $url = 'http://bppsdmk.kemkes.go.id/info_sdmk/info/distribusi_sdmk_rs_per_prov?prov=53';
        $crawler = $client->request('GET', $url);
        $data = $crawler->filter('table.display > tr')->each(function ($node) {
            return [
                "kode_pusat" => $node->filter('td')->eq(2)->text(),
                "kode_rs" => $node->filter('td')->eq(3)->text(),
                "city" => $node->filter('td')->eq(1)->text(),
                "name" => $node->filter('td')->eq(4)->text(),
                "type" => $node->filter('td')->eq(5)->text(),
                "class" => $node->filter('td')->eq(6)->text(),
                "jumlah_dokter_umum" => $node->filter('td')->eq(7)->text(),
                "jumlah_dokter_gigi" => $node->filter('td')->eq(8)->text(),
                "jumlah_dokter_spesialis_penyakit_dalad" => $node->filter('td')->eq(9)->text(),
                "jumlah_dokter_spesialis_obgyn" => $node->filter('td')->eq(10)->text(),
                "jumlah_dokter_spesialis_anak" => $node->filter('td')->eq(11)->text(),
                "jumlah_dokter_spesialis_bedah" => $node->filter('td')->eq(12)->text(),
                "jumlah_dokter_spesialis_radiologi" => $node->filter('td')->eq(13)->text(),
                "jumlah_dokter_spesialis_anestesi" => $node->filter('td')->eq(14)->text(),
                "jumlah_dokter_spesialis_patologi_klinik" => $node->filter('td')->eq(15)->text(),
                "jumlah_dokter_spesialis_patologi_anatomi" => $node->filter('td')->eq(16)->text(),
                "jumlah_dokter_spesialis_rehabilitasi_medik" => $node->filter('td')->eq(17)->text(),
                "jumlah_dokter_spesialis_lain" => $node->filter('td')->eq(18)->text(),
                "jumlah_dokter_gigi_spesialis" => $node->filter('td')->eq(19)->text(),
                "perawat" => $node->filter('td')->eq(20)->text(),
                "bidan" => $node->filter('td')->eq(21)->text(),
                "farmasi" => $node->filter('td')->eq(22)->text(),
                "gizi" => $node->filter('td')->eq(23)->text(),
                "ksehatan_masyarakat" => $node->filter('td')->eq(24)->text(),
                "kesehatan_lingkungan" => $node->filter('td')->eq(25)->text(),
                "keterapian_fisik" => $node->filter('td')->eq(26)->text(),
                "keteknisan_medik" => $node->filter('td')->eq(27)->text(),
                "teknik_biomedika" => $node->filter('td')->eq(28)->text()              
            ];
        });
        return response()->json([
            "status" => 200,
            "message" => "Success",
            "data" => $data
        ], 200);
    }
}