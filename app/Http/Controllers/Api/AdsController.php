<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Ads, AdImages};
use App\Http\Requests\GetAllAdsRequest;

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



    public function index(GetAllAdsRequest $request) {
        $perpage = ($request->has('per_page')) ? $request->get('per_page') : "5";
        $ad_type = ($request->get('ad_type') == "rent") ? "louer" : "vente";
        $data = Ads::select(["id", "localisation", "texte_fr", "prix", "type", "surf_hab", "piece", "ville", "nb_garage", "nb_chambre", "nb_salle_deau", "nb_sdb", "dpe_consom_energ", "dpe_emissions_ges"])->with('photos')->where('operation', $ad_type);
        if ($request->has('type') && !empty($request->get('type'))) {
            $data->where('type', $request->get('type'));
        }
        if ($request->has('location') && !empty($request->get('location'))) {
            $data->where(function($q) use ($request) {
                $q->where('adresse', 'like', "%".$request->get('location')."%")->orWhere('localisation', 'like', "%".$request->get('location')."%")->orWhere('ville', 'like', "%".$request->get('location')."%");
            });
        }
        if ($request->has('rooms') && !empty($request->get('rooms'))) {
            $data->where('piece', $request->get('rooms'));
        }
        if ($request->has('budget_min') && !empty($request->get('budget_min'))) {
            $data->where('prix', '>=', $request->get('budget_min'));
        }
        if ($request->has('budget_max') && !empty($request->get('budget_max'))) {
            $data->where('prix', '<=', $request->get('budget_max'));
        }
        if ($request->has('reference') && !empty($request->get('reference'))) {
            $data->where('reference', 'like', "%".$request->get('reference')."%");
        }

        $sort_by = "id";
        $sorting_order = "DESC";
        if ($request->has('sort_by') && !empty($request->get('sort_by'))) {
            $sort_by = $request->get('sort_by');
        }
        if ($request->has('order_by') && !empty($request->get('order_by'))) {
            $sorting_order = $request->get('order_by');
        }
        $data = $data->orderBy($sort_by, $sorting_order)->paginate($perpage);
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
        $return_data['created_at'] = date('Y-m-d H:i:s');
        return $return_data;
    }
}