<?php

/**
 * Authentication Service
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
require_once '../../config.php';
require_once '../../service/connect.php';

if (!isset($_SESSION['LOGIN']['user']['id'])) {
    header('Location: ../../login.php');
}
if (!isset($_SESSION['LOGIN']['access_token'])) {
    header('Location: ../../login.php');
} else {
    $jwtToken = $_SESSION['LOGIN']['access_token'];
    // echo $jwtToken, '<br/>';
    $tokenParts = explode('.', $jwtToken);
    if (count($tokenParts) === 3) {
        $payloadJson = base64_decode($tokenParts[1]);
        $payload = json_decode($payloadJson, 1);

        // echo '<pre>', print_r($payload, 1), '</pre>';
        // echo '1: ', $payload['exp'], '<br/>';
        // echo '2: ', time(), '<br/>';
        if ($payload['exp'] <= time()) {
            // echo '1: ', $payload['exp'], '<br/>';
            // echo '2: ', time(), '<br/>';
            // echo '3: Expire', '<br/>';
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => API_URL . 'admin/refresh',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                    'Authorization: bearer ' . $jwtToken
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;


            // $curl = curl_init();

            // curl_setopt_array($curl, array(
            //     CURLOPT_URL => 'http://localhost:8000/api/admin/refresh',
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => '',
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 0,
            //     CURLOPT_FOLLOWLOCATION => true,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => 'POST',
            //     CURLOPT_HTTPHEADER => array(
            //         'Accept: application/json',
            //         'Authorization: bearer '.
            //     ),
            // ));

            // $response = curl_exec($curl);

            // curl_close($curl);

            $login = json_decode($response, true);

            // echo '<pre>', print_r($login), '</pre>';

            $_SESSION['LOGIN'] = $login['data'];
        }
    }
}
