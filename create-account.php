<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
        
    <title>Create Account</title>
    <style>
        .container{
            animation: transitionIn-X 0.5s;
        }
    </style>
</head>
<body>
<?php

require 'vendor/autoload.php';

use Carbon\Carbon;  

//learn from w3schools.com
//Unset all the server side variables

session_start();

$_SESSION["user"]="";
$_SESSION["usertype"]="";

// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');

$_SESSION["date"]=$date;

$timeNow = Carbon::now('Asia/Kolkata');


//import database
include("connection.php");



if(isset($_POST['submit'])){

    $date = date('Y-m-d H:i:s');
    $result= $database->query("select * from webuser");

    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['secondPassword'];
    $created_at = $timeNow;
    $updated_at = $timeNow;
    
    if ($password==$cpassword){
        $result= $database->query("select * from webuser where email='$email';");
        if($result->num_rows==1){
           $_SESSION['message'] = 'User already exists!';
            header('location: public/login-1.php');
        }else{
            //insert query into patient table;
            $database->query('insert into patient(first_name,last_name,email,password,created_at,updated_at) values("'.$fname.'","'.$lname.'","'.$email.'","'.$password.'","'.$created_at.'","'.$updated_at.'")');
            $database->query("insert into webuser values('$email','p')");

            //print_r("insert into patient values($pid,'$email','$fname','$lname','$newpassword','$address','$nic','$dob','$tele');");
            $_SESSION["user"]=$email;
            $_SESSION["usertype"]="p";
            $_SESSION["username"]=$fname;
            $_SESSION['message'] = 'Account created successfully!';
            header('Location: patient/index.php');
        }
        
    }else{
        $_SESSION['message'] = 'Password does not match!';
        header('location: sign_up.php');
    }
    
}else{
    //header('location: signup.php');
    $_SESSION['message'] = 'Please fill the form!';
    header('location: sign_up.php');
}

?>
