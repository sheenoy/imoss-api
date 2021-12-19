<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Ads, AdImages};

class AdsController extends Controller
{
    public function readXmlAndSaveData(Request $request) {
        $xmlDataString  = file_get_contents(public_path('xml-flux/75059.xml'));
        $xmlObject      = simplexml_load_string($xmlDataString);
        $data           = json_decode(json_encode($xmlObject), true);
        $ads            = $data['annonce'];
        foreach($ads as $ad) {
            $photos = (isset($ad['liste_photos']['photo'])) ? $ad['liste_photos']['photo'] : [];
            unset($ad['liste_photos']);
            $ad = $this->processAdsData($ad);
            $ad_id = Ads::insertGetId($ad);
            foreach ($photos as $photo) {
                if($photo != "") {
                    $photo_data = [
                        'ad_id' => $ad_id,
                        'image_url' => $photo
                    ];
                    $insert_photo = AdImages::insert($photo_data);
                }
            }

        }
        return response()->json(['status' => "success", 'message' => "XML data inserted successfully!!", 'data' => $ads]);
    }



    public function index(Request $request) {
        $perpage = ($request->has('per_page')) ? $request->get('per_page') : "5";
        $data = Ads::with('photos');

        $data = $data->paginate($perpage);
        return response()->json($data);
   }


    public function detail(Request $request, $id) {
        $data = Ads::with('photos')->find($id);
        return response()->json(['status' => "success", 'message' => "Ad details successfully fetched!!", 'data' => $data]);
    }

    public function processAdsData($data) {
        $return_data = [];
        foreach($data as $key => $val) {
            $val = (is_array($val)) ? "" : $val; 
            $return_data[$key] = $val;
        }
        return $return_data;
    }
}