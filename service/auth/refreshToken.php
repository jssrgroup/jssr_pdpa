<?php
header('Content-Type: application/json');

require '../../config.php';
require_once '../connect.php';

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
        'Authorization: bearer ' . $_SESSION['LOGIN']['access_token']
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

$login = json_decode($response, true);

$_SESSION['LOGIN'] = $login['data'];

// http_response_code(200);
// echo json_encode($response = [
//     'status' => true,
//     'message' => 'Login Success'
// ]);
