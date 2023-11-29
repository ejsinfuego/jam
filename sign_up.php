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

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
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
                    <h2>Sign up</h2>
                    <p class="justify-content-center w-lg-50">Create an account to check more services and book an appointment seamlessly.</p>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-5">
                        <div class="card-body d-flex flex-column" style="border-radius: 6px;border: 2px solid var(--bs-primary-border-subtle);box-shadow: 5px 5px var(--bs-primary-border-subtle);padding: 50px;">
                            <h2>Registration</h2>
                            <?php if(isset($_SESSION['message'])){
                                echo ' <div class="alert alert-success mb-sm-0" role="alert" style="border-style: none;background: rgba(209,231,221,0);padding-top: 0px;padding-bottom: 0px;padding-left: 0px;padding-right: 0px;margin-left: 2px;margin-right: 2px;"><span><strong>Alert</strong>'.$_SESSION['message'].'></span></div>';
                                unset($_SESSION['message']);
                            } ?>
                            <form class="text-center" method="POST" action="create-account.php">
                                <label class="form-label d-lg-flex align-items-lg-center" style="margin-top: 18px;">Email</label>
                                <div class="mb-3">
                                    <input class="form-control" type="email" name="email" placeholder="Email">
                                </div>
                                <label class="form-label d-lg-flex align-items-lg-center" style="margin-top: 18px;">Password</label>
                                <div class="mb-3">
                                    <input class="form-control" type="password" name="password" placeholder="password">
                                </div>
                                <label class="form-label d-lg-flex align-items-lg-center" style="margin-top: 18px;">Confirm Password</label>
                                <div class="mb-3">
                                    <input class="form-control" type="password" name="secondPassword" placeholder="Confirm password">
                                </div>
                                <input class="form-control" type="hidden" name="firstName" value="<?php echo $firstName; ?>" placeholder="Confirm password">
                                <input class="form-control" type="hidden" name="lastName" value="<?php echo $lastName; ?>">
                                <input class="btn btn-primary d-block w-100" type="submit" name="submit" value="submit" style="background: rgb(26,188,156);border-style: none;--bs-body-color: #d5dbdb;color: #fbfff1; hover:#ffffff;"></input>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include('_footer.php'); ?>