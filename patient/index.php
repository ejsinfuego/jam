<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
<?php
include('../connection.php');
session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p' and $_SESSION['usertype']!='d'){
            header("location: ../login-1.php");
        }else{
            $useremail=$_SESSION["user"];
        }
    }else{
        header("location: ../login-1.php");
    }
    
    if($_SESSION['usertype']=='p'){
        include("../connection.php");
        $userrow = $database->query("select * from patient where email='$useremail'");
        $userfetch=$userrow->fetch_assoc();
        $userid= $userfetch["id"];
        $username=$userfetch["first_name"];
        $med_link = "../patients/request_medicine.php";
        $med_link_sidebar = "../patients/medicine_requests.php";
        $appointment_link = "../patients/book_appointment.php";
        $appointment_link_sidebar = "../patients/appointments.php";
        $index = "../patients/index.php";
        $services = "../patient/services.php";
    }else{
        //import database
        include("../connection.php");
        $userrow = $database->query("select * from doctor where docemail='$useremail'");
        $userfetch=$userrow->fetch_assoc();
        $userid= $userfetch["docid"];
        $username=$userfetch["docname"];
        $med_link = "../doctors/medicine_inventory.php";
        $appointment_link = "../doctors/appointments.php";
        $med_link_sidebar = "../doctors/medicine_requests.php";
        $appointment_link_sidebar = "../doctors/appointments.php";
        $index = "../doctors/index.php";
    }

    $availServices = $database->query('select * from services');

    $title = 'Orfanel-Mendoza Dental Clinic';
    $page = 'Home';

    
$braces = '../assets/img/braces.jpg';
$prophylaxis = '../assets/img/prophylaxis.jpg';
$restoration = '../assets/img/restoration.jpg';
$extraction = '../assets/img/extraction.jpg';

?><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?= $title.' | '.$page; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alexandria&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alumni+Sans+Collegiate+One&amp;display=swap">
    <link rel="stylesheet" href="../assets/css/styles.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <style>
         .btn:hover{
            background: white;
            height: auto;
        }
        
        .serv:hover{
            background: white;
            color: #1abc9c;
        }
</style>
</head>

<body style="font-family: Alexandria, sans-serif;background: #fbfff1;  background-image: url('../assets/img/main_bg.png'); background-size: 400px 200px; background-attachment: fixed;">
    <div class="container py-2">
    <div class="row df-l mb-3">
        <nav class="col navbar d-flex navbar-expand-md bg-body d-flex d-xxl-flex flex-row justify-content-center align-items-center justify-content-xxl-center align-items-xxl-center py-3" style="background: rgb(44,62,80);font-family: Alexandria, sans-serif;border-radius: 6px;box-shadow: 2px 2px var(--bs-primary-border-subtle);border: 2px solid var(--bs-primary-border-subtle);width: auto;">
            <div class="container-fluid"><a class="navbar-brand d-flex align-items-center" href="index.php"><img src="../assets/img/logo.png" width="54" height="54" /><span class="d-flex px-sm-4" style="color: var(--bs-gray-600);font-size: 18px;text-shadow: 1px 1px #1abc9c;margin-left: -19px;margin-right: -19px;">Orfanel-Mendoza Dental Clinic</span><a class="px-lg-5 px-xxl-3"><?php echo $username; ?></a><button class="navbar-toggler" data-bs-toggle="collapse"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        </div>
    </nav>  
    <?php if(isset($_SESSION['message']) && $_SESSION['message'] !=''){
                    echo '<div id="message" class="alert text-center text-bold fade show" role="alert" style="margin-top: 18px; font-family: Alexandria, sans-serif; background-color: none;">'.$_SESSION['message'].'</div>';
                    unset($_SESSION['message']);} ?>
    </div>
        <section class="text-white" style="height: auto;">
            <div class="container">
                <div class="border rounded border-0 d-flex flex-column justify-content-center align-items-center p-4 py-5" style="background: linear-gradient(rgba(0,123,255,0.2) 0%, rgba(0,123,255,0.2) 84%, rgb(44,62,80) 100%), url(&quot;../assets/img/bg.png&quot;) center / cover;height: 500px;box-shadow: 5px 5px var(--bs-primary-border-subtle);border: 2px solid var(--bs-gray-500);border-bottom: 2px none #abb2b9;">
                    <div class="row">
                        <div class="col-md-10 col-xl-8 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                            <div>
                                <h1 class="text-uppercase fw-bold bounce animated mb-3" style="text-shadow: -3px 4px #1abc9c;">Orfanel-Mendoza DENTAL CLINIC</h1>
                                <p class="bounce animated mb-4">Have your teeth a treat.</p>
                                <?php if(isset($_SESSION['usertype']) and $_SESSION['usertype'] != '') : ?>
                                    <a href="<?php echo $services; ?>" id="" class="btn serv fs-5 me-2 py-2 px-4" type="button" style="background: #1abc9c;border-style: none;color: rgb(213,219,219);">Check Services</a>
                                    <a href="appointments.php" class="btn btn-light fs-5 py-2 px-4 my-0 mx-0" type="button" style="background: transparent;border-style: none;color: #1abc9c;">Book an Appointment</a>
                                <?php else :?>
                                    <a href="../login-1.php"class="btn btn-primary fs-5 me-2 py-2 px-4" type="button" style="background: #1abc9c;border-style: none;color: rgb(213,219,219);">Login</a><a href="../sign_up.php" class="btn btn-light fs-5 py-2 px-4 my-0 mx-0" type="button" style="background: transparent;border-style: none;color: #1abc9c;">Register</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="container py-3 py-xl-5">
        <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
        <?php foreach($availServices as $service) :?>
            <div class="col">
                <div class="card"><img class="img-fluid card-img-top w-100 d-block bounce animated fit-cover" style="height: 200px;box-shadow: 5px 5px var(--bs-primary-border-subtle);border-radius: 6px;border-top-left-radius: 6px;border: 2px solid var(--bs-primary-border-subtle) ;" src="
                <?php
                if($service['service'] == 'Braces'){
                    echo $braces;
                }elseif($service['service'] == 'Oral Prophylaxis'){
                    echo $prophylaxis;
                }elseif($service['service'] == 'Restoration (Pasta)'){
                    echo $restoration;
                }elseif($service['service'] == 'Extraction'){
                    echo $extraction;
                }
                ?>
                ">
                    <div class="card-body bounce animated p-4" style="box-shadow: 5px 5px var(--bs-primary-border-subtle);border-radius: 6px;border-top-left-radius: 6px;border: 2px solid var(--bs-primary-border-subtle) ; height: 400px;">
                        <p class="text-primary card-text mb-0">Service</p>
                        <h4 class="card-title"><?php echo $service['service']; ?></h4>
                        <p class="card-text"><?php echo $service['description']; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php if(isset($_SESSION['usertype']) and $_SESSION['usertype'] != ''){
        }else{
          echo '<section class="position-relative py-4 py-xl-5" id="register">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center" style="color: #3c3744;">
                    <div class="col-xxl-4" data-aos="fade-up">
                        <h3 class="text-start d-flex justify-content-center align-items-center align-content-center" style="margin-top: 24px;">Create an account so you can check how much more we can help you.</h3>
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4 flex-column align-self-center" style="padding-top: 15px;">
                        <div class="card mb-5">
                            <div class="card-body p-sm-5" data-aos="slide-up" style="color: #3c3744;border: 2px solid var(--bs-primary-border-subtle);border-radius: 6px;box-shadow: 5px 5px var(--bs-primary-border-subtle);">
                                <h2 class="text-center mb-4">Register Here</h2>
                                <form method="post" action="../sign_up.php">
                                    <div class="mb-3"><input class="form-control" type="text" id="name-2" name="firstName" placeholder="First Name"></div>
                                    <div class="mb-3"><input class="form-control" type="text" id="email-2" name="lastName" placeholder="Last Name"></div>
                                    <div class="mb-3"></div>
                                    <div><button class="btn btn-secondary d-block w-100" type="submit" style="color: #f1f0f0;">Submit</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>';}  ?>
    </div>
    <div class="card my-5" style="max-width: auto; box-shadow: 5px 5px var(--bs-primary-border-subtle);border-radius: 6px;border-top-left-radius: 6px;border: 2px solid var(--bs-primary-border-subtle) ;">
    <div class="row g-0">
        <?php
            while(true){
                $rand = rand(9, 15);
                if($rand != 9 and $rand != 10 and $rand != 13){
                    break;
                }
            }
         ?>
        <div id="carousel-1" class="carousel slide w-50 h-50" data-bs-ride="false">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img class="w-100 h-50 img-responsive rounded" src="../assets/img/10.jpg" alt="Slide Image"/></div>
        <div class="carousel-item rounded"><img class="w-100 d-block img-responsive rounded" src="../assets/img/9.jpg" alt="Slide Image" />
        </div>
        <div class="carousel-item"><img class="w-100 d-block img-responsive rounded" src="../assets/img/<?= $rand; ?>.jpg" alt="Slide Image" /></div>
    </div>
    <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></a></div>
    <div class="carousel-indicators"><button class="active" type="button" data-bs-target="#carousel-1" data-bs-slide-to="0"></button><button type="button" data-bs-target="#carousel-1" data-bs-slide-to="1"></button><button type="button" data-bs-target="#carousel-1" data-bs-slide-to="2"></button></div>
</div>
        <div class="col-md-3 mt-5 ms-2">
            <div class="card-body">
                <h5 class="card-title">Visit Us</h5>
                <p class="card-text">Whether you need a routine check-up, cosmetic dentistry, orthodontics, or specialized care, we offer a comprehensive range of dental services. Our goal is to be your go-to destination for all your oral health needs, providing personalized care that exceeds your expectations.</p>
                <p class="card-text"><small class="text-muted"><a href="#"></a>Our Location</a></small></p>
            </div>
        </div>
    </div>
</div>
    
<?php include('../_footer.php'); ?>