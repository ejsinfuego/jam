<?php

session_start();

require '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::today();

include('../connection.php');

$services = $database->query('select * from services');

?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>jam</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alexandria&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alumni+Sans+Collegiate+One&amp;display=swap">
    <link rel="stylesheet" href="../assets/css/styles.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
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
                                <a href="../login-1.php"class="btn btn-primary fs-5 me-2 py-2 px-4" type="button" style="background: #1abc9c;border-style: none;color: rgb(213,219,219);">Login</a><a href="#register" class="btn btn-light fs-5 py-2 px-4 my-0 mx-0" type="button" style="background: transparent;border-style: none;color: #1abc9c;">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="container">
         <div class="container">
    <div class="row gy-4 gy-md-0">
        <div class="col-md-6">
            <div class="p-xl-5 d-flex justify-content-end"><img class="rounded img-fluid w-50 fit-cover" style="min-height: 300px; max-height: 500px; box-shadow: 5px 5px var(--bs-primary-border-subtle);border: 2px solid var(--bs-primary-border-subtle);border-radius: 5px;" src="../assets/img/dentist.jpg" /></div>
        </div>
        <div class="col-md-6 d-md-flex align-items-md-center">
            <div style="max-width: 400px;">
                <h2 class="text-uppercase fw-bold">Dr. Josefina Eligia Orfanel-Mendoza</h2>
                <p class="my-3">With over 10 years of experience, <strong>Dr. Josefina Eligia Orfanel-Mendoza</strong> is a trusted name in the field of dentistry. Our state-of-the-art dental practice is equipped with the latest technology to ensure that you receive the best possible care.</p><a class="btn btn-primary btn-lg me-2" role="button" href="#services">Services</a>
            </div>
        </div>
    </div>
    </div>
    </div>
   
    <div class="container py-4 py-xl-5" data-aos="fade-up" id="services">
        <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
            <?php foreach($services as $service) : ?>
            <div class="col">
                <div class="card"><img class="card-img-top w-100 d-block bounce animated fit-cover" style="height: 200px;border: 2px solid var(--bs-primary-bg-subtle);border-radius: 6px;box-shadow: 5px 5px var(--bs-primary-border-subtle);" src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png">
                    <div class="card-body bounce animated p-4" style="border: 2px solid var(--bs-primary-bg-subtle);border-radius: 6px;box-shadow: 5px 5px var(--bs-primary-border-subtle);">
                        <p class="text-primary card-text mb-0">Service</p>
                        <h4 class="card-title"><?php echo $service['service'] ?></h4>
                        <p class="card-text"><?php echo $service['description']; ?></p>
                        <div class="d-flex"><a href="../login-1.php">
                            Book an appointment..
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
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
                        <p class="text-muted">Eros ligula lobortis elementum amet commodo ac nibh ornare, eu lobortis.</p>
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
    <footer class="text-center">
        <div class="container text-muted py-4 py-lg-5" style="box-shadow: 8px 3px rgb(171,178,185);border-radius: 6px;border: 2px solid rgb(171,178,185);">
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
</body>

</html>
