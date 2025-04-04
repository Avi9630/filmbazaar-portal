<?php

namespace App\Http\Controllers;

use App\Libraries\Constant;
use App\Libraries\Curl;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\FilmMaker;
use App\Models\Country;

class CurlController extends Controller
{
    public function sendRequest(Request $request)
    {
        $url = 'https://ficcibike.com/waves2025/sync/registerDatae.php'; // Replace with your API URL

        $payload    = $request->all();
        $filmMakerId = 2903;
        // $filmMakerId    =   $request->input('id');
        $filmMaker      =   FilmMaker::find($filmMakerId);
        $countryName    =   Country::where('id', $filmMaker['country_id'])->pluck('name')->first();

        if (isset($filmMaker['sectors']) && !empty($filmMaker['sectors'])) {
            $sector         =   Constant::sectors()[$filmMaker['sectors'][1]];
        } else {
            $sector         =   '';
        }
        $payload['emailid']         =   $filmMaker['email'];
        $payload['name']            =   $filmMaker['first_name'] . ' ' . $filmMaker['last_name'];
        $payload['designation']     =   $filmMaker['job_profile'];
        $payload['companyname']     =   $filmMaker['company'];
        $payload['country']         =   $countryName;
        $payload['productprofile']  =   $countryName;;
        $payload['companyprofile']  =   $filmMaker['company_type'];
        $payload['sector']          =   $sector;
        $payload['photo']           =   isset($filmMaker['photo']) ? $filmMaker['photo'] : '';

        try {
            $response = Curl::posthit($payload, $url, $headers = [], $request_type = '');
            $response = $response['body'];
            if ((isset($response) && $response['status'] != 1) || empty($response)) {
                return [
                    'status'  => false,
                    'data'    => $response,
                ];
            } else {
                FilmMaker::where('id', $filmMakerId)->update(['asigned_b2b' => 1]);
                return [
                    'status'  => true,
                    'data'    => $response
                ];
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
