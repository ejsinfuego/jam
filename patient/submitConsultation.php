<?php

require '../vendor/autoload.php';
use Carbon\Carbon;

$timeNow = Carbon::now('Asia/Kolkata');


    include("../connection.php");
    //get all rows of date and time
    session_start();
    

    if(isset($_POST)){
        $type=$_POST['type'];
        $time=$_POST['time'];
        $date=$_POST['date'];
        $pid=$_POST['patient_id'];
        $timestamp= $timeNow;

        $search = $database->query("select * from appointments where appointmentDate='$date' and appointmentTime='$time'"); //check whether the scheduled date has already been taken

        if($search->num_rows==0){
            if(($timeNow->format('Y') <= date('Y', strtotime($date)) and $timeNow->format('m') <= date('m', strtotime($date)) and $timeNow->format('d') <= date('d', strtotime($date)) and $timeNow->format('h:i a') != date('h:i a', strtotime($time)))){
            $database->query("insert into appointments(service_id, appointmentDate, appointmentTime, patient_id, created_at, updated_at) values('$type','$date','$time','$pid','$timestamp','$timestamp')");
            $_SESSION['message']="Appointment Request Sent!";
            header("location: calendar.php");
            }elseif($timeNow->format('Y') > date('Y', strtotime($date)) and $timeNow->format('m') > date('m', strtotime($date)) and $timeNow->format('d') > date('d', strtotime($date)) and $timeNow->format('h:i a') > date('h:i a', strtotime($time))){
                $_SESSION['message']="Time and Date already passed!";
                header("location: calendar.php");
            }
            
        }else{
            $_SESSION['message']="Time and Date already taken!";
            header("location: calendar.php");
        }
    }else{
    header("location: ../something_went_wrong.php");
    }

    
?>