<?php
require_once '../../../config.php';
require_once '../../../service/connect.php';
// echo '<pre>', print_r($_SESSION, 1), '</pre>';
// echo '<pre>', print_r($_SERVER, 1), '</pre>';
if (!isset($_SESSION['LOGIN']['user']['id'])) {
    header('Location: ../../../login.php');
}
