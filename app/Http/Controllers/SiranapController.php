<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class SiranapController extends Controller
{
    public function regency(Request $request) {        
        return response()->json([
            "status" => 200,
            "message" => "Success",
            "data" => [
                ["id" => 5301, "name" => "Sumba Barat" ],
                ["id" => 5302, "name" => "Sumba Timur" ],
                ["id" => 5303, "name" => "Kupang" ],
                ["id" => 5304, "name" => "Timor Tengah Selatan" ],
                ["id" => 5305, "name" => "Timor Tengah Utara" ],
                ["id" => 5306, "name" => "Belu" ],
                ["id" => 5307, "name" => "Alor" ],
                ["id" => 5308, "name" => "Lembata" ],
                ["id" => 5309, "name" => "Flores Timur" ],
                ["id" => 5310, "name" => "Sikka" ],
                ["id" => 5311, "name" => "Ende" ],
                ["id" => 5312, "name" => "Ngada" ],
                ["id" => 5313, "name" => "Manggarai" ],
                ["id" => 5314, "name" => "Rote Ndao" ],
                ["id" => 5315, "name" => "Manggarai Barat" ],
                ["id" => 5316, "name" => "Sumba Tengah" ],
                ["id" => 5317, "name" => "Sumba Barat Daya" ],
                ["id" => 5318, "name" => "Nagekeo" ],
                ["id" => 5319, "name" => "Manggarai Timur" ],
                ["id" => 5320, "name" => "Sabu Raijua" ],
                ["id" => 5321, "name" => "Malaka" ],
                ["id" => 5371, "name" => "Kota Kupang" ]                
            ]
        ], 200);
    }

    public function bedAvalaibilityForCovid(Request $request) {        
        $client = new Client(HttpClient::create(['timeout' => 60]));
        $url = 'http://yankes.kemkes.go.id/app/siranap/rumah_sakit?jenis=1&propinsi=53prop&kabkota='.$request->kabkota;
        $crawler = $client->request('GET', $url);
        $data = $crawler->filter('.cardRS')->each(function ($node) {
            $url = $node->filter('a')->attr('href');
            $url_components = parse_url($url);            
            parse_str($url_components['query'], $params);
            return [
                "id" => $params['kode_rs'],
                "name" => $node->filter('h5.mb-0')->text(),
                "address" => $node->filter('p.mb-0')->text(),
                "status" => $node->filter('.mt-0.mb-1')->text(),
                "capacity" => $node->filter('.col-md-5.text-right > p.mb-0')->text(),
                "queue" => $node->filter('.col-md-5.text-right > p.mb-0')->eq(1)->text(),
                "lastUpdate" => $node->filter('.col-md-5.text-right > p.mb-0')->eq(2)->text(),
                "contact" => $node->filter('span')->text()
            ];
        });
        return response()->json([
            "status" => 200,
            "message" => "Success",
            "data" => $data
        ], 200);
    }

    public function bedAvalaibilityForCovidDetail(Request $request, $id) {        
        $client = new Client(HttpClient::create(['timeout' => 60]));
        $url = 'https://yankes.kemkes.go.id/app/siranap/tempat_tidur?kode_rs='.$id.'&jenis=1&propinsi=53prop&kabkota=';
        $crawler = $client->request('GET', $url);
        $data = $crawler->filter('.card')->each(function ($node) {
            $queue = NULL;
            if ($node->filter('.text-center.pt-1.pb-1')->eq(2)->filter('div')->eq(2)->count() > 0) {
                $queue = $node->filter('.text-center.pt-1.pb-1')->eq(2)->filter('div')->eq(2)->text();
            }
            return [
                "name" => substr_replace($node->filter('p.mb-0')->text() ,"",-27),
                "lastUpdate" => $node->filter('p.mb-0 > small')->text(),
                "totalBed" => $node->filter('.text-center.pt-1.pb-1')->eq(0)->filter('div')->eq(2)->text(),
                "empty" => $node->filter('.text-center.pt-1.pb-1')->eq(1)->filter('div')->eq(2)->text(),
                "waitingList" => $queue
            ];
        });
        $address = $crawler->filter('.mb-0 > small')->text();
        $phone = ltrim($crawler->filter('.fa.fa-phone')->text(), '&nbsp ');
        $removeCharacter= strlen($phone) + strlen($address) + 8;
        $name = substr_replace($crawler->filter('.mb-0')->text(), "", -$removeCharacter);
        return response()->json([
            "status" => 200,
            "message" => "Success",
            "data" => [
                "name" => $name,
                "address" => $address,
                "phone" => $phone,
                "room" => $data
            ]
        ], 200);
    }

    public function bedAvalaibilityForNonCovid(Request $request) {        
        $client = new Client(HttpClient::create(['timeout' => 60]));
        $url = 'https://yankes.kemkes.go.id/app/siranap/rumah_sakit?jenis=2&propinsi=53prop&kabkota='.$request->kabkota;
        $crawler = $client->request('GET', $url);
        $data = $crawler->filter('.cardRS')->each(function ($node) {
            $url = $node->filter('a')->attr('href');
            $url_components = parse_url($url);            
            parse_str($url_components['query'], $params);
            $name = $node->filter('.col-md-5 > h5.mb-0')->text();
            $address = $node->filter('.col-md-5 > p.mb-0')->text();
            $phone = $node->filter('.card-footer.text-right > div > span')->text();
            $data = $node->filter('.col-md-4.text-center.mb-2')->each(function ($node) {
                return [
                    "title" => $node->filter('.text-center')->eq(2)->text(),
                    "location" => $node->filter('.text-center')->eq(3)->text(),
                    "total" => $node->filter('.text-center')->eq(1)->text(),
                    "lastUpdate" => $node->filter('.text-center')->eq(4)->text()
                ];
            });
            return [
                "id" => $params['kode_rs'],
                "name" => $name,
                "address" => $address,
                "contact" => $phone,
                "data" => $data
            ];
        });
        return response()->json([
            "status" => 200,
            "message" => "Success",
            "data" => $data
        ], 200);
    }

    public function bedAvalaibilityForNonCovidDetail(Request $request, $id) {        
        $client = new Client(HttpClient::create(['timeout' => 60]));
        $url = 'https://yankes.kemkes.go.id/app/siranap/tempat_tidur?kode_rs='.$id.'&jenis=2&propinsi=53prop&kabkota=';
        $crawler = $client->request('GET', $url);
        $data = $crawler->filter('.card')->each(function ($node) {
            return [
                "name" => substr_replace($node->filter('p.mb-0')->text() ,"",-27),
                "lastUpdate" => $node->filter('p.mb-0 > small')->text(),
                "totalBed" => $node->filter('.text-center.pt-1.pb-1')->eq(0)->filter('div')->eq(2)->text(),
                "empty" => $node->filter('.text-center.pt-1.pb-1')->eq(1)->filter('div')->eq(2)->text()
            ];
        });
        $address = $crawler->filter('.mb-0 > small')->text();
        $phone = ltrim($crawler->filter('.fa.fa-phone')->text(), '&nbsp ');
        $removeCharacter= strlen($phone) + strlen($address) + 8;
        $name = substr_replace($crawler->filter('.mb-0')->text(), "", -$removeCharacter);
        return response()->json([
            "status" => 200,
            "message" => "Success",
            "data" => [
                "name" => $name,
                "address" => $address,
                "phone" => $phone,
                "room" => $data
            ]
        ], 200);
    }
}