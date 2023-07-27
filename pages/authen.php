<?php 
    /**
     * Authentication Service
     * 
     * @link https://appzstory.dev
     * @author Yothin Sapsamran (Jame AppzStory Studio)
     */
    require_once '../../config.php';
    require_once '../../service/connect.php' ; 
    if( !isset($_SESSION['LOGIN']['user']['id'] ) ){
        header('Location: ../../login.php');  
    }
?>