<?php
//write a code that delete service from the database

session_start();
include '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::now('Asia/Kolkata');

include('../connection.php');

if($_SESSION['usertype'] != 'd'){
    header('location: ../something_went_wrong.php');
}

if(isset($_GET['id'])){
    $service_id = $_GET['id'];
    $deleteService = $database->query("delete from services where id='$service_id'");
    $_SESSION['message'] = 'Service was deleted.';
    header('location: services.php');
}
$_SESSION['message'] = 'Service was not deleted.';
header('location: services.php');


?>