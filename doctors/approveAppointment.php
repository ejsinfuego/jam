<?php 
//script to approve appointment
session_start();
//include the database connection
include_once('../connection.php');
require '../vendor/autoload.php';
use Carbon\Carbon;


//get the id of the appointment
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $timenow = Carbon::now();

    //query to update the appointment
    $result = $database->query("UPDATE appointments SET updated_at = '$timenow', status = 'Approved' WHERE id = '$id';");

    //if the query is successful, redirect to appointments.php
    if($result){
        $_SESSION['message'] = "Appointment approved";
        header('location: appointments.php');
        exit;
    }else{
        echo "Something went wrong";
    }
}else{
    header('location: appointments.php');
    exit;
}
?>