<?php

namespace App\Http\Controllers;

use App\Libraries\Constant;
use App\Libraries\Curl;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\FilmMaker;
use App\Models\FilmBuyer;
use App\Models\Country;
use App\Models\Image_temp;

class CurlController extends Controller
{
    public function sendRequest(Request $request)
    {
        $url = 'https://ficcibike.com/waves2025/sync/registerDatae.php'; // Replace with your API URL

        $payload    = $request->all();
        // $filmMakerId = 1;
        $filmMakerId    =   $request->input('id');
        $filmMakers = FilmMaker::where('id', $filmMakerId)->get();
        foreach ($filmMakers as $filmMaker) {
            $countryName    =   Country::where('id', $filmMaker['country_id'])->pluck('name')->first();


            $sector         =   [];
            if (isset($filmMaker['sectors']) && !empty($filmMaker['sectors'])) {
                $sectors = json_decode($filmMaker['sectors']);
                foreach ($sectors as $key => $value) {
                    if ($value != 0 && !empty(Constant::sectors()[$value]))
                        $sector[] =   Constant::sectors()[$value];
                }
            }
            if ($filmMaker['profile']) {
                $Image_temp    =   Image_temp::find($filmMaker['profile']);
            }
            $datatobeSend = array();
            $datatobeSend['emailid']         =   $filmMaker['email'];
            $datatobeSend['name']            =   $filmMaker['first_name'] . ' ' . $filmMaker['last_name'];
            $datatobeSend['designation']     =   $filmMaker['job_profile'];
            $datatobeSend['companyname']     =   $filmMaker['company'];
            $datatobeSend['country']         =   $countryName;
            $datatobeSend['productprofile']  =   $filmMaker['company'];
            $datatobeSend['companyprofile']  =   $filmMaker['company_profile'];
            $datatobeSend['mobile']          =   $filmMaker['phone_number'];
            $datatobeSend['sector']          =   implode(", ", $sector);;
            $datatobeSend['photo'] = isset($Image_temp['url'])
                ? "https://wavesbazaar.com/api/project/file/read/" . $Image_temp['url']
                : '';

            try {
                $response = Curl::posthit($datatobeSend, $url, $headers = [], $request_type = '');
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


    public function sendRequestForBuyer(Request $request)
    {
        $url = 'https://ficcibike.com/waves2025/sync/registerDatad.php'; // Replace with your API URL

        $payload    = $request->all();
        // $filmMakerId = 1059;
        $filmMakerId    =   $request->input('id');
        $filmMaker      =   FilmBuyer::find($filmMakerId);
        $countryName    =   Country::where('id', $filmMaker['country_id'])->pluck('name')->first();
        $Image_temp = null;
        if ($filmMaker['passport_photo']) {
            $Image_temp    =   Image_temp::find($filmMaker['passport_photo']);
        }
        $sectors = json_decode($filmMaker['segments']);

        $sector         =   [];
        if (isset($filmMaker['segments']) && !empty($filmMaker['segments'])) {
            $sectors = json_decode($filmMaker['segments']);
            foreach ($sectors as $key => $value) {
                if ($value != 0)
                    $sector[] =   Constant::sectors()[$value];
            }
        }

        $datatobeSend = array();
        $datatobeSend['emailid']         =   $filmMaker['email'];
        $datatobeSend['name']            =   $filmMaker['first_name'] . ' ' . $filmMaker['last_name'];
        $datatobeSend['designation']     =   $filmMaker['job_title'];
        $datatobeSend['companyname']     =   $filmMaker['company'];
        $datatobeSend['country']         =   $countryName;
        $datatobeSend['productprofile']  =   $filmMaker['company'];
        $datatobeSend['companyprofile']  =   $filmMaker['company_profile'];
        $datatobeSend['mobile']          =   $filmMaker['mobile'];
        $datatobeSend['telephone']           =   $filmMaker['phone'];
        $datatobeSend['industry']        =   implode(", ", $sector);
        $datatobeSend['sector']          =   implode(", ", $sector);;
        $datatobeSend['photo']           = isset($Image_temp['url'])
            ? "https://wavesbazaar.com/api/project/file/read/" . $Image_temp['url']
            : '';

        try {
            $response = Curl::posthit($datatobeSend, $url, $headers = [], $request_type = '');

            $response = $response['body'];
            if ((isset($response) && $response['status'] != 1) || empty($response)) {
                return [
                    'status'  => false,
                    'data'    => $response,
                    'datatobeSend' => $datatobeSend
                ];
            } else {
                FilmBuyer::where('id', $filmMakerId)->update(['asigned_b2b' => 1, 'payed' => 2]);
                return [
                    'status'  => true,
                    'data'    => $response,
                    'datatobeSend' => $datatobeSend
                ];
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
