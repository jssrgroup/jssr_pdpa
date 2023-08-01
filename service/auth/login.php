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
// Array
// (
//     [LOGIN] => Array
//         (
//             [access_token] => eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9hZG1pblwvbG9naW4iLCJpYXQiOjE2OTA2MDQxOTIsImV4cCI6MTY5MDYwNzc5MiwibmJmIjoxNjkwNjA0MTkyLCJqdGkiOiJsZUZaVXAxdVNKdDJTQTBMIiwic3ViIjo3MSwicHJ2IjoiZjJlZmE3NDk1OTU1NjFmYTI2M2RmYTM4ZDEwZWM3M2RlNjg2MjJhYiIsInVzZXJuYW1lIjoiYW51c29ybiIsImVtcGlkIjoiQUlFNTYtNTYtMDMwIn0.YyYTgw-8XTDvgp3EgOfrzSRHrvfY6ugQB5nWYWfKf8o
//             [user] => Array
//                 (
//                     [id] => 71
//                     [username] => anusorn
//                     [empId] => AIE56-56-030
//                     [name] => นายอนุสรณ์  บุญเขตต์
//                     [department] => AM
//                     [email] => 
//                     [phone] => 
//                     [status] => 1
//                     [statusAdmin] => 0
//                     [lastLogin] => 1690604192
//                     [accessList] => Array
//                         (
//                             [0] => 5
//                             [1] => 6
//                             [2] => 7
//                             [3] => 8
//                             [4] => 9
//                             [5] => 25
//                             [6] => 33
//                         )

//                     [accessRegister] => 
//                     [accessInspection] => 
//                     [accessGeneral] => 
//                     [role] => Array
//                         (
//                             [userId] => 71
//                             [depId] => 2
//                             [roleId] => 3
//                             [status] => 1
//                             [isDelete] => 0
//                         )

//                 )

//         )

// )

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
