<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>jam</title>
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
<body>
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
                                <a href="public/index.html#register" class="btn btn-primary shadow-sm d-block w-100 mt-xxl-2 my-sm-2" type="submit" style="background: rgba(44,62,80,0.23);color: var(--bs-dark-text-emphasis);border-color: #1abc9c;">Sign up</a></div>
                                <a href="#" class="text-muted">Forgot your password?</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="text-center">
            <div class="container text-muted py-4 py-lg-5">
                <ul class="list-inline">
                    <li class="list-inline-item me-4"><a class="link-secondary" href="#">Web design</a></li>
                    <li class="list-inline-item me-4"><a class="link-secondary" href="#">Development</a></li>
                    <li class="list-inline-item"><a class="link-secondary" href="#">Hosting</a></li>
                </ul>
                <ul class="list-inline">
                    <li class="list-inline-item me-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-facebook">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                        </svg></li>
                    <li class="list-inline-item me-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-twitter">
                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
                        </svg></li>
                    <li class="list-inline-item"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-instagram">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                        </svg></li>
                </ul>
                <p class="mb-0">Copyright © 2023 Brand</p>
            </div>
        </footer>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>