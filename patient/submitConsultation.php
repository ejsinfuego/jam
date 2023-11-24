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

        $search = $database->query("select * from appointments where appointmentDate='$date'"); //check whether the scheduled date has already been taken
        
        if($search->num_rows==0){
            if(($timeNow->format('Y') <= date('Y', strtotime($date)) and $timeNow->format('m') <= date('m', strtotime($date)) and $timeNow->format('d') <= date('d', strtotime($date)) and $timeNow->format('h:i a') != date('h:i a', strtotime($time)))){
            $database->query("insert into appointments(service_id, appointmentDate, appointmentTime, patient_id, created_at, updated_at) values('$type','$date','$time','$pid','$timestamp','$timestamp')");
            $_SESSION['show_modal']="myModal";
            $_SESSION['message']="Appointment Request Sent!";
            header("location: calendar.php");
            }elseif(
                $timeNow->format('Y') == date('Y', strtotime($date)) and 
                $timeNow->format('m') == date('m', strtotime($date)) and 
                $timeNow->format('d') == date('d', strtotime($date)) and 
                $timeNow->format('h:i a') > date('h:i a', strtotime($time))){
                $_SESSION['show_modal']="myModal";
                $_SESSION['message']="Time and Date already passed!";
                header("location: calendar.php");
            }elseif(
                $timeNow->format('Y') > date('Y', strtotime($date)) and 
                $timeNow->format('m') > date('m', strtotime($date)) and 
                $timeNow->format('d') > date('d', strtotime($date)) and 
                $timeNow->format('h:i a') > date('h:i a', strtotime($time))){
                $_SESSION['show_modal']="myModal";
                $_SESSION['message']="Time and Date already passed!";
                header("location: calendar.php");
            }
        }elseif($search->num_rows>0){
            $flag = 0;
            $time = date('h:i', strtotime($time));
            foreach($search as $appointment){

                //set each time to 30 minutes before and after the appointment time
                //check if resched_details is not null
                if($appointment['resched_details'] != null){
                    $start = new DateTime(date('h:i', strtotime('-1 hour', strtotime($appointment['resched_details']))));
                    $end = new DateTime(date('h:i', strtotime('+1 hour', strtotime($appointment['resched_details']))));
                }else{
                    $start = new DateTime(date('h:i', strtotime('-1 hour', strtotime($appointment['appointmentTime']))));
                    $end = new DateTime(date('h:i', strtotime('+1 hour', strtotime($appointment['appointmentTime'])))); 
                }

                //interval in minutes
               $interval = new DateInterval('PT1M');

                $period = new DatePeriod($start, $interval, $end);
                foreach($period as $dt){
                    if($dt->format('h:i') == $time or $dt->format('h:i') == $time or $dt->format('h:i') == date('h:i a', strtotime('+30 minutes', strtotime($time))) or $dt->format('h:i') == date('h:i a', strtotime('-30 minutes', strtotime($time)))){
                        $flag = ++$flag;
                        break;  
                    }
                    }
            }if($flag > 0){
                $_SESSION['show_modal']="myModal";
                $_SESSION['message']="Please choose another time. 1 hour before and after the appointment time is already taken.";
                header("location: calendar.php");
            }
            else{
                //insert
                var_dump($period);
                $database->query("insert into appointments(service_id, appointmentDate, appointmentTime, patient_id, created_at, updated_at) values('$type','$date','$time','$pid','$timestamp','$timestamp')");
                header("location: calendar.php");
            }
            // $_SESSION['show_modal']="myModal";
            // $_SESSION['message']="Time and Date already taken!";
            // header("location: calendar.php");
        }
    }else{
        $_SESSION['show_modal']="myModal";
        $_SESSION['message']="Something went wrong.";
        header("location: calendar.php");
    }