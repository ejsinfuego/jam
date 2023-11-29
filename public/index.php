<?php

session_start();

require '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::today();

include('../connection.php');

$services = $database->query('select * from services');

$events = $database->query('select * from events');

$title = $title ?? 'Orfanel-Mendoz Dental Clinic';
$page = $page ?? 'Home';

$braces = '../assets/img/braces.jpg';
$prophylaxis = '../assets/img/prophylaxis.jpg';
$restoration = '../assets/img/restoration.jpg';
$extraction = '../assets/img/ext.jpg';

?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?= $title.' | '.$page; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alexandria&amp;display=swap">
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

</head>

<body style="font-family: Alexandria, sans-serif;background: #fbfff1;">
    <div class="container">
        <section class="text-white py-4 py-xl-5">
            <div class="container">
                <div class="border rounded border-0 d-flex flex-column justify-content-center align-items-center p-4 py-5" style="background: linear-gradient(rgba(0,123,255,0.2) 0%, rgba(0,123,255,0.2) 84%, rgb(44,62,80) 100%), url(&quot;../assets/img/bg.png&quot;) center / cover;height: 500px;box-shadow: 5px 5px var(--bs-primary-border-subtle);border: 2px solid var(--bs-gray-500);border-bottom: 2px none #abb2b9;" data-aos="fade-up">
                    <div class="row">
                        <div class="col-md-10 col-xl-8 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                            <div>
                                <h1 class="text-uppercase fw-bold animated mb-3" style="text-shadow: -3px 4px #1abc9c;">Orfanel-Mendoza Dental Clinic</h1>
                                <p class="faded animated mb-4" data-aos="fade-up">At Orfanel-Mendoza Dental Clinic, your oral health and smile are our top priorities. We are a dedicated team of dental professionals committed to providing you and your family with the highest quality dental care in a warm and welcoming environment.</p>
                                <a href="../login-1.php" class="btn btn-primary fs-5 me-2 py-2 px-4" type="button" style="background: #1abc9c;border-style: none;color: rgb(213,219,219);">Login</a><a href="#services" class="btn btn-light fs-5 py-2 px-4 my-0 mx-0" type="button" style="background: transparent;border-style: none;color: #1abc9c;">Services</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
   
   
    <div class="container py-4 py-xl-5" data-aos="fade-up" id="services">
        <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
            <?php foreach($services as $service) : ?>
            <div class="col">
                <div class="card"><img class="card-img-top w-100 d-block bounce animated fit-cover" style="height: 200px;border: 2px solid var(--bs-primary-bg-subtle);border-radius: 6px;box-shadow: 5px 5px var(--bs-primary-border-subtle);" src="
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
                    <div class="card-body bounce animated p-4" style="border: 2px solid var(--bs-primary-bg-subtle);border-radius: 6px;box-shadow: 5px 5px var(--bs-primary-border-subtle);">
                        <p class="text-primary card-text mb-0">Service</p>
                        <h4 class="card-title"><?php echo $service['service'] ?></h4>
                        <p class="card-text ps-2" style="font-family:Arial, Helvetica, sans-serif;"><?php echo $service['description']; ?></p>
                        <div class="d-flex"><a href="../login-1.php">
                            Book an appointment..
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <div class="row gy-5 gy-lg-1 row-cols-4 row-cols-md-2 row-cols-lg-1">
            <?php foreach($events as $event) : ?>
                <div class="col ms-4">
                <div class="card" style="Alexandria, sans-serif;border-radius: 6px;box-shadow: 2px 2px var(--bs-primary-border-subtle);border: 2px solid var(--bs-primary-border-subtle);width: auto;"><img class="card-img-top w-100 d-block fit-cover" style="height: 200px; " src="<?php echo (isset($event['image'])) ? '../doctors/eventpics/'.$event['image'] :'https://cdn.bootstrapstudio.io/placeholders/1400x800.png' ; ?>"/>
                <div class="card-body p-4">
                    <p class="text-primary card-text mb-0">Promo</p>
                    <h4 class="card-title"><?php echo $event['title']; ?></h4>
                    <hr style="border: 1px solid #6c757d;">
                    <p class="card-text"><?php echo $event['description']; ?></p>
                    <p>Start on <strong><?php echo date('F d, Y', strtotime($event['start'])); ?></strong> until <strong><?php echo date('F d, Y', strtotime($event['end'])); ?></strong></p>
                    </div>
                </div>
            </div>
            </div>
            <?php endforeach; ?>
        <div class="container">
         <div class="container">
    <div class="row gy-4 gy-md-0">
        <div class="col-md-6">
            <div class="p-xl-5 d-flex justify-content-end"><img class="rounded img-fluid w-50 fit-cover" style="min-height: 300px; max-height: 500px; box-shadow: 5px 5px var(--bs-primary-border-subtle);border: 2px solid var(--bs-primary-border-subtle);border-radius: 5px;" src="../assets/img/dentist.jpg" /></div>
        </div>
        <div class="col-md-6 d-md-flex align-items-md-center">
            <div style="max-width: 400px;">
                <h2 class="text-uppercase fw-bold">Dr. Josefina Eligia Orfanel-Mendoza</h2>
                <p class="my-3">With over 20 years of experience, <strong>Dr. Josefina Eligia Orfanel-Mendoza</strong> is a trusted name in the field of dentistry. Our state-of-the-art dental practice is equipped with the latest technology to ensure that you receive the best possible care.</p><a class="btn btn-primary btn-lg me-2" role="button" href="#services">Services</a>
            </div>
        </div>
    </div>
    </div>
    <div class="card mb-3" style="max-width: auto;">
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
                <h5 class="card-title">We're more than happy to serve you!</h5>
                <p class="card-text">Whether you need a routine check-up, cosmetic dentistry, orthodontics, or specialized care, we offer a comprehensive range of dental services. Our goal is to be your go-to destination for all your oral health needs, providing personalized care that exceeds your expectations.</p>
                <p class="card-text"><small class="text-muted"><a href="#map">Our Location</a></small></p>
            </div>
        </div>
    </div>
</div>
    </div>
        <section class="position-relative py-4 py-xl-5" id="register">
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
                                    <div class="mb-3"></div>
                                    <div class="mb-3">
                                    <label for="firstName">First Name</label><input class="form-control" type="text" id="name-2" name="firstName" placeholder="First Name"></div>
                                    <div class="mb-3">
                                        <label for="firstName">Last Name</label>
                                        <input class="form-control" type="text" id="email-2" name="lastName" placeholder="Last Name"></div>
                                    <div class="mb-3"></div>
                                    <div><button class="btn btn-secondary d-block w-100" type="submit" style="color: #f1f0f0;">Submit</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="position-relative py-4 py-xl-5" style="border-radius: 5px;border-style: solid;border-color: var(--bs-primary-border-subtle);box-shadow: 5px 5px var(--bs-primary-border-subtle);">
    <div class="container position-relative">
        <div class="row">
            <div id="map" class="col"></div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div>
                    <form class="p-3 p-xl-4" method="post">
                        <h4>Contact us</h4>
                        <p class="text-muted">Come visit us. You can also send us a message</p>
                        <div class="mb-3"><label class="form-label" for="name">Name</label><input id="name" class="form-control" type="text" name="name" /></div>
                        <div class="mb-3"><label class="form-label" for="email">Email</label><input id="email" class="form-control" type="email" name="email" /></div>
                        <div class="mb-3"><label class="form-label" for="message">Message</label><textarea id="message" class="form-control" name="message" rows="6"></textarea></div>
                        <div class="mb-3"><button class="btn btn-primary" type="submit">Send </button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
    var map = L.map('map').setView([13.6328271, 123.4980034],50);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = L.marker([13.6328271,123.4980034]).addTo(map);

    marker.bindPopup("Orfanel-Mendoza Dental Clinic").openPopup();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="../assets/js/script.min.js"></script>
<?php include("../_footer.php"); ?>
