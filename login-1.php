<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alexandria&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alumni+Sans+Collegiate+One&amp;display=swap">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>
<?php

//learn from w3schools.com
//Unset all the server side variables

session_start();

$_SESSION["user"]="";
$_SESSION["usertype"]="";

// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');

$_SESSION["date"]=$date;


//import database
include("connection.php");

if($_POST){

    $email=$_POST['email'];
    $password=$_POST['password'];
    

    $result= $database->query("select * from webuser where email='$email'");
    if($result->num_rows==1){
        $utype=$result->fetch_assoc()['usertype'];
        if ($utype=='p'){
            $checker = $database->query("select * from patient where email='$email' and password='$password'");
            if ($checker->num_rows==1){
                //   Patient dashbord
                $_SESSION['user']=$email;
                $_SESSION['usertype']='p';
                header('location: patient/index.php');

            }else{
                $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }

        }elseif($utype=='a'){
            $checker = $database->query("select * from admin where aemail='$email' and apassword='$password'");
            if ($checker->num_rows==1){


                //   Admin dashbord
                $_SESSION['user']=$email;
                $_SESSION['usertype']='a';
                
                header('location: admin/index.php');

            }else{
                $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }

        }elseif($utype=='d'){
            $checker = $database->query("select * from doctor where email='$email' and password='$password'");
            if ($checker->num_rows==1){

                //   doctor dashbord
                $_SESSION['user']=$email;
                $_SESSION['usertype']='d';
                $_SESSION['id']=$checker->fetch_assoc()['id'];
                header('location: doctors/index.php');

            }else{
                $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }
        }   
    }else{
        $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We cant found any acount for this email.</label>';
    }
}
?>
<body style="background-image: url('assets/img/main_bg.png'); background-size: 400px 200px; background-attachment: fixed;">
    <section class="position-relative py-4 py-xl-5" style="font-family: Alexandria, sans-serif;">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto"></div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-5 col-xxl-4 d-flex flex-column justify-content-start align-items-center" style="background: url(&quot;assets/img/bg.png&quot;);padding: 76px;height: 410px;color: #fbfff1;border-radius: 6px;box-shadow: 5px 5px #abb2b9;">
                    <h2>Log in</h2>
                    <p class="justify-content-center w-lg-50">You have to log in first before setting up an appointment so that we can better save you. If does not have an account yet, click sign up</p>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-5">
                        <div class="card-body d-flex flex-column align-items-center" style="border-radius: 6px;border: 2px solid var(--bs-primary-border-subtle);box-shadow: 5px 5px var(--bs-primary-border-subtle);">
                            <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4" style="background: #1abc9c;border: 2px solid #abb2b9;box-shadow: 0px 0px #abb2b9;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"></path>
                                </svg></div>
                            <form class="text-center mb-3" method="POST">
                                <div class="mb-3">
                                <?php if(isset($error)){
                                echo $error;
                                    }?>
                                <input class="form-control" type="email" name="email" placeholder="Email"></div>
                                <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="mb-3" style="--bs-body-color: #d5dbdb;"><button class="btn btn-primary d-block w-100" type="submit" style="background: rgb(26,188,156);border-style: none;--bs-body-color: #d5dbdb;color: #fbfff1;">Login</button>
                                <a href="public/index.php#register" class="btn btn-primary shadow-sm d-block w-100 mt-xxl-2 my-sm-2" type="submit" style="background: rgba(44,62,80,0.23);color: var(--bs-dark-text-emphasis);border-color: #1abc9c;">Sign up</a></div>
                                <a href="#" class="text-muted">Forgot your password?</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include("_footer.php");?>