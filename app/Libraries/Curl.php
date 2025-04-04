<?php

namespace App\Libraries;

use CURLFile;

class Curl
{
    private static function headersToArray($str)
    {
        $headers = array();
        $headersTmpArray = explode('\r\n', $str);
        for (
            $i = 0;
            $i < count($headersTmpArray);
            ++$i
        ) {
            if (strlen($headersTmpArray[$i]) > 0) {
                if (strpos($headersTmpArray[$i], ':')) {
                    $headerName = substr($headersTmpArray[$i], 0, strpos($headersTmpArray[$i], ':'));
                    $headerValue = substr($headersTmpArray[$i], strpos($headersTmpArray[$i], ':') + 1);
                    $headers[$headerName] = $headerValue;
                }
            }
        }
        return $headers;
    }

    public static function hit($request, $method = 'GET', $pennyUrl, $headers)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $pennyUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($request),
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        return $response;
    }

    public static function posthit($request, $url, $headers = [], $request_type = '')
    {
        // if (is_array($request)) {
        //     $request = json_encode($request, TRUE);
        // }
        // if ($request_type == 'array') {
        //     $request = json_decode($request, TRUE);
        // }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 1,
            CURLOPT_TIMEOUT => 190,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $request,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_HEADER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ));

        $curl_result = curl_exec($curl);
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $statuscode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $headers = self::headersToArray(substr($curl_result, 0, $header_size));

        if (curl_errno($curl)) {
            $response = array('statuscode' => curl_errno($curl), 'message' => 'Unable to get response, please try again after sometime.', 'error' => curl_error($curl));
        } else {
            $response = substr($curl_result, $header_size);
            $response = json_decode($response, TRUE);
        }
        curl_close($curl);
        return array('statuscode' => $statuscode, 'headers' => $headers, 'body' => $response);
    }

    public static function hits($request, $url, $headers)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL             => $url,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_TIMEOUT         => 180,
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST   => 'POST',
            CURLOPT_POSTFIELDS      => $request,
            CURLOPT_HTTPHEADER      => $headers,
        ));
        $curl_result = curl_exec($curl);
        $statuscode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (curl_errno($curl)) {
            $response = array('statuscode' => curl_errno($curl), 'message' => 'Unable to get response, please try again after sometime.', 'error' => curl_error($curl));
        } else {
            $response = json_decode($curl_result, TRUE);
        }
        curl_close($curl);
        return array('statuscode' => $statuscode, 'body' => $response);
    }

    public static function muffin_hits($request, $url, $headers)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL             => $url,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_TIMEOUT         => 180,
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST   => 'POST',
            CURLOPT_POSTFIELDS      => $request,
            CURLOPT_HTTPHEADER      => $headers,
        ));
        $curl_result = curl_exec($curl);
        $statuscode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (curl_errno($curl)) {
            $response = array('statuscode' => curl_errno($curl), 'message' => 'Unable to get response, please try again after sometime.', 'error' => curl_error($curl));
        } else {
            $response = str_replace(array("\n", "\r", "\t"), '', $curl_result);
        }
        curl_close($curl);
        return array('statuscode' => $statuscode, 'body' => $response);
    }

    public static function gethit($request = '', $url, $headers = [])
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS  => $request,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ));
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $response = array('statuscode' => curl_errno($curl), 'message' => 'Unable to get response, please try again after sometime.', 'error' => curl_error($curl));
        } else {
            $response = json_decode($response, TRUE);
        }
        curl_close($curl);
        return $response;
    }

    public static function uploadSvImage($request, $user)
    {
        $url = 'https://docs.paysprint.in/upload/uploadsvimage';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'token' => 'baf9dcfd1ee9ca2954a356666d413108',
                'image' => new CURLFILE(
                    $request['file']->path(),
                    $request['file']->getMimeType(),
                    $request['file']->getClientOriginalName()
                )
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    public static function gethits($url, $headers = [])
    {
        $url    =   rtrim($url, '&');
        $curl   =   curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL             =>  $url,
            CURLOPT_RETURNTRANSFER  =>  true,
            CURLOPT_ENCODING        =>  '',
            CURLOPT_MAXREDIRS       =>  10,
            CURLOPT_TIMEOUT         =>  0,
            CURLOPT_FOLLOWLOCATION  =>  true,
            CURLOPT_HTTP_VERSION    =>  CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST   =>  'GET',
            CURLOPT_HTTPHEADER      =>  $headers,
            CURLOPT_SSL_VERIFYPEER  =>  false,
            CURLOPT_SSL_VERIFYHOST  =>  false,
        ]);
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $response = [
                'statuscode'    =>  curl_errno($curl),
                'message'       =>  'Unable to get response, please try again after sometime!!',
                'error'         =>  curl_error($curl)
            ];
        } else {
            $response = json_decode($response, TRUE);
        }
        curl_close($curl);
        return [
            'statuscode'    =>  200,
            'headers'       =>  '',
            'body'          =>  $response
        ];
    }

    public static function crimeCheckHits($request, $url, $headers, $apikey)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL             => $url,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_TIMEOUT         => 180,
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST   => 'POST',
            CURLOPT_POSTFIELDS      => $request,
            CURLOPT_HTTPHEADER      => $headers,
            CURLOPT_USERPWD         => $apikey,
        ));
        $curl_result = curl_exec($curl);

        $statuscode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (curl_errno($curl)) {
            $response = array(
                'statuscode'    =>  curl_errno($curl),
                'message'       =>  'Unable to get response, please try again after sometime.',
                'error'         =>  curl_error($curl)
            );
        } else {
            $response = json_decode($curl_result, TRUE);
        }
        curl_close($curl);
        return array('statuscode' => $statuscode, 'body' => $response);
    }

    public static function crimeCheckJson($url, $headers = [])
    {
        $url    =   rtrim($url, '&');
        $curl   =   curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL             =>  $url,
            CURLOPT_RETURNTRANSFER  =>  true,
            CURLOPT_ENCODING        =>  '',
            CURLOPT_MAXREDIRS       =>  10,
            CURLOPT_TIMEOUT         =>  0,
            CURLOPT_FOLLOWLOCATION  =>  true,
            CURLOPT_HTTP_VERSION    =>  CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST   =>  'GET',
            CURLOPT_HTTPHEADER      =>  $headers,
            CURLOPT_SSL_VERIFYPEER  =>  false,
            CURLOPT_SSL_VERIFYHOST  =>  false,
        ]);

        $response       =   curl_exec($curl);

        if (curl_errno($curl)) {
            $response = [
                'statuscode'    =>  curl_errno($curl),
                'message'       =>  'Unable to get response, please try again after sometime!!',
                'error'         =>  curl_error($curl)
            ];
        } else {
            $response = json_decode($response, TRUE);
        }
        curl_close($curl);
        return [
            'statuscode'    =>  200,
            'headers'       =>  '',
            'body'          =>  $response
        ];
    }

    public static function crimeCheckPDF($url, $headers = [])
    {
        $url    =   rtrim($url, '&');
        $curl   =   curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL             =>  $url,
            CURLOPT_RETURNTRANSFER  =>  true,
            CURLOPT_ENCODING        =>  '',
            CURLOPT_MAXREDIRS       =>  10,
            CURLOPT_TIMEOUT         =>  0,
            CURLOPT_FOLLOWLOCATION  =>  true,
            CURLOPT_HTTP_VERSION    =>  CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST   =>  'GET',
            CURLOPT_HTTPHEADER      =>  $headers,
            CURLOPT_SSL_VERIFYPEER  =>  false,
            CURLOPT_SSL_VERIFYHOST  =>  false,
        ]);
        $curl_result   =   curl_exec($curl);

        $statuscode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (curl_errno($curl)) {
            $response = array(
                'statuscode'    =>  curl_errno($curl),
                'message'       =>  'Unable to get response, please try again after sometime.',
                'error'         =>  curl_error($curl)
            );
        } else {
            $responseArray = json_decode($curl_result, TRUE);
            if (is_array($responseArray) && !empty($responseArray)) {
                $response = $responseArray;
            } else {
                $response = base64_encode($curl_result);
            }
        }
        curl_close($curl);
        return array('statuscode' => $statuscode, 'body' => $response);
    }

    public static function callbackshits($url, $data)
    {
        unset($data['reference_id']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'User-Agent: sprintverify server',
            ),
        ));
        $curl_result = curl_exec($curl);
        $statuscode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (curl_errno($curl)) {
            $response = array('statuscode' => curl_errno($curl), 'message' => 'Unable to get response, please try again after sometime.', 'error' => curl_error($curl));
        } else {
            $response = json_decode($curl_result, TRUE);
        }
        curl_close($curl);
        return array('statuscode' => $statuscode, 'body' => $response);
    }

    public static function yblHit($request, $url, $headers = [])
    {
        $requestEncrypted = json_encode($request);
        $curl   =   curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.uatyespayhub.in/services/disbursement/pd");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_ENCODING, "");
        curl_setopt($curl, CURLOPT_MAXREDIRS, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 190);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $requestEncrypted);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, 1);

        $curl_result    =   curl_exec($curl);
        $header_size    =   curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $statuscode     =   curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $headers = self::headersToArray(substr($curl_result, 0, $header_size));

        if (curl_errno($curl)) {
            $response = [
                'statuscode'    =>  curl_errno($curl),
                'message'       =>  'Unable to get response, please try again after sometime!!',
                'error'         =>  curl_error($curl)
            ];
        } else {
            $response   =   substr($curl_result, $header_size);
            $response   =   json_decode($response, TRUE);
        }
        curl_close($curl);
        return  [
            'statuscode'    =>  $statuscode,
            'headers'       =>  $headers,
            'body'          =>  $response
        ];
    }
}
