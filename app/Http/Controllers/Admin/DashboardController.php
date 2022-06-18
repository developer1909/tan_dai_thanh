<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
//        $curl = curl_init();
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => 'https://api.shipengine.com/v1/labels',
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => 'POST',
//            CURLOPT_POSTFIELDS =>'{
//  "shipment": {
//    "service_code": "fedex_ground",
//    "ship_to": {
//      "name": "Jane Doe",
//      "address_line1": "525 S Winchester Blvd",
//      "city_locality": "San Jose",
//      "state_province": "CA",
//      "postal_code": "95128",
//      "country_code": "US",
//      "address_residential_indicator": "yes"
//    },
//    "ship_from": {
//      "name": "John Doe",
//      "company_name": "Example Corp",
//      "phone": "555-555-5555",
//      "address_line1": "4009 Marathon Blvd",
//      "city_locality": "Austin",
//      "state_province": "TX",
//      "postal_code": "78756",
//      "country_code": "US",
//      "address_residential_indicator": "no"
//    },
//    "packages": [
//      {
//        "weight": {
//          "value": 20,
//          "unit": "ounce"
//        },
//        "dimensions": {
//          "height": 6,
//          "width": 12,
//          "length": 24,
//          "unit": "inch"
//        }
//      }
//    ]
//  }
//}',
//            CURLOPT_HTTPHEADER => array(
//                'Host: api.shipengine.com',
//                'API-Key: TEST_/lQbjXcaOm34Kq+wXIzBth/SuA9ZoYwxLvSp/20XnRw',
//                'Content-Type: application/json'
//            ),
//        ));
//
//        $response = curl_exec($curl);
//        curl_close($curl);
//        $data = json_decode($response);
//        dd($data);
        return view('admin.home');
    }
}
