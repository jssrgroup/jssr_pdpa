<?php

/**
 **** AppzStory Back Office Management System Template ****
 * PHP Login API
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
header('Content-Type: application/json');
require '../../config.php';
require_once '../connect.php';

/**
 |--------------------------------------------------------------------------
 | ตรวจสอบ Username ในฐานข้อมูล
 | 'SELECT * FROM users where username = :username'
 |--------------------------------------------------------------------------

 |--------------------------------------------------------------------------
 | ตรวจสอบ Password ว่าตรงกันหรือไม่ 
 | password_verify($password, $user[0]['password'])
 |--------------------------------------------------------------------------
 */
$credencial = array(
    "username" => $_POST['username'],
    "password" => $_POST['password'],
);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => API_URL.'admin/login',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => http_build_query($credencial),
));

$response = curl_exec($curl);

curl_close($curl);
$login = json_decode($response, true);
// echo $response;
/** 
 * ตั้งค่า Session ไว้ใช้งาน 
 */
$_SESSION['LOGIN'] = $login['data'];

/** 
 * กำหนดข้อมูลสำหรับการ Response ไปยังฝั่ง Client
 * 
 * @return array 
 */
http_response_code(200);
echo json_encode($response = [
    'status' => true,
    'message' => 'Login Success'
]);
