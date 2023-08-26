<?php 
use Carbon\Traits\ToStringFormat;

session_start();

$title = 'Index';

include('../connection.php');

include '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::now()->format('Y-m-d');


//get the name of user
$name = $database->query("SELECT * FROM doctor WHERE id = {$_SESSION['id']}")->fetch_assoc();

$appointments = $database->query("SELECT * FROM appointments WHERE cancel_details='no'")->fetch_all();
$appointmentsToday = count($database->query("SELECT * FROM appointments WHERE appointmentDate = '$today' AND cancel_details='no'")->fetch_all());

$patients = $database->query("SELECT * FROM patient")->fetch_all();
$services = $database->query("SELECT * FROM services")->fetch_all();
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo htmlspecialchars($title, ENT_QUOTES); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alexandria&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alumni+Sans+Collegiate+One&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css">
    <link rel="stylesheet" href="../assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="../assets/css/Articles-Cards-images.css">
    <link rel="stylesheet" href="../assets/css/Bootstrap-Calendar.css">
    <link rel="stylesheet" href="../assets/css/Navbar-Centered-Brand-icons.css">
</head>

<body style="font-family: Alexandria, sans-serif;background: #fbfff1;">
    <div class="container" style="padding: 0px;">
        <section class="text-white py-4 py-xl-5" style="height: 152px;">
            <div class="container" style="padding: 0px;">
                <div class="border rounded border-0 d-flex flex-column justify-content-center align-items-center p-4 py-5" style="background: linear-gradient(rgba(0,123,255,0.2) 0%, rgba(0,123,255,0.2) 84%, rgb(44,62,80) 100%), url(&quot;../assets/img/bg.png&quot;) center / cover;height: 121px;box-shadow: 5px 5px var(--bs-primary-border-subtle);border: 2px solid var(--bs-gray-500);border-bottom: 2px none #abb2b9;">
                    <div class="row d-flex d-xxl-flex">
                        <div class="col-md-10 col-xl-8 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                            <div>
                                <h1 class="text-uppercase fw-bold bounce animated mb-3" style="text-shadow: -3px 4px #1abc9c;padding-bottom: 0px;margin-top: 15px;margin-bottom: 15px;">welcome,
                            <?php echo $name['first_name']." ".$name['last_name']; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="container py-4 py-xl-5 mb-lg-0 pb-lg-3 pb-xxl-4" style="margin-bottom: 1px;">
        <div class="row gy-4 row-cols-2 row-cols-md-4" style="font-family: Alexandria, sans-serif;">
            <div class="col">
                <a href="appointments.php" class="text-decoration-none text-body">
                <div class="text-center d-flex flex-column justify-content-center align-items-center py-3" style="border-style: solid;border-color: #6c757d;border-radius: 6px;box-shadow: 4px 3px #6c757d;">
                    <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-32 0 512 512" width="1em" height="1em" fill="currentColor">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M152 64H296V24C296 10.75 306.7 0 320 0C333.3 0 344 10.75 344 24V64H384C419.3 64 448 92.65 448 128V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V128C0 92.65 28.65 64 64 64H104V24C104 10.75 114.7 0 128 0C141.3 0 152 10.75 152 24V64zM48 248H128V192H48V248zM48 296V360H128V296H48zM176 296V360H272V296H176zM320 296V360H400V296H320zM400 192H320V248H400V192zM400 408H320V464H384C392.8 464 400 456.8 400 448V408zM272 408H176V464H272V408zM128 408H48V448C48 456.8 55.16 464 64 464H128V408zM272 192H176V248H272V192z"></path>
                        </svg></div>
                    <div class="px-3">
                        <h2 class="fw-bold mb-0"><?php echo count($appointments); ?></h2>
                        <p class="mb-0">Appointments</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col">
                <div class="text-center d-flex flex-column justify-content-center align-items-center py-3" style="border-style: solid;border-color: #6c757d;border-radius: 6px;box-shadow: 4px 3px #6c757d;">
                    <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M256 112c-48.6 0-88 39.4-88 88C168 248.6 207.4 288 256 288s88-39.4 88-88C344 151.4 304.6 112 256 112zM256 240c-22.06 0-40-17.95-40-40C216 177.9 233.9 160 256 160s40 17.94 40 40C296 222.1 278.1 240 256 240zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-46.73 0-89.76-15.68-124.5-41.79C148.8 389 182.4 368 220.2 368h71.69c37.75 0 71.31 21.01 88.68 54.21C345.8 448.3 302.7 464 256 464zM416.2 388.5C389.2 346.3 343.2 320 291.8 320H220.2c-51.36 0-97.35 26.25-124.4 68.48C65.96 352.5 48 306.3 48 256c0-114.7 93.31-208 208-208s208 93.31 208 208C464 306.3 446 352.5 416.2 388.5z"></path>
                        </svg></div>
                    <div class="px-3">
                        <h2 class="fw-bold mb-0"><?php echo count($patients); ?></h2>
                        <p class="mb-0">Patients</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="text-center d-flex flex-column justify-content-center align-items-center py-3" style="border-style: solid;border-color: #6c757d;border-radius: 6px;box-shadow: 4px 3px #6c757d;">
                    <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person-workspace">
                            <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"></path>
                            <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"></path>
                        </svg></div>
                    <div class="px-3">
                        <h2 class="fw-bold mb-0"><?php echo count($services); ?></h2>
                        <p class="mb-0">Services</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="text-center d-flex flex-column justify-content-center align-items-center py-3" style="border-style: solid;border-color: #6c757d;border-radius: 6px;box-shadow: 4px 3px #6c757d;">
                    <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg"><i class="material-icons" style="font-size: 38px;">rss_feed</i></div>
                    <div class="px-3">
                        <h2 class="fw-bold mb-0">89</h2>
                        <p class="mb-0">Feedback</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container position-relative" style="padding-right: 0px;padding-left: 0px;">
        <section class="py-4 py-xl-5 pt-xxl-0 pt-lg-0 my-lg-0 mb-lg-0" style="padding: 0px 0px;height: 194.4px;margin-bottom: -20px;">
            <div class="text-white bg-primary border rounded border-0 border-primary d-flex flex-column justify-content-between flex-lg-row p-4 p-md-5" style="border: 2px solid #6c757d;box-shadow: 4px 6px #6c757d;padding: 48px;">
                <div class="pb-2 pb-lg-1">
                    <h2 class="fw-bold mb-2"><?php echo $appointmentsToday; ?> Appointments today.&nbsp;</h2>
                    <p class="mb-0">Click the button on the right to see.</p>
                </div>
                <div class="my-2"><a class="btn btn-light fs-5 py-2 px-4" role="button" href="#" style="background: var(--bs-secondary);color: #fbfff1;border-style: none;">Button</a></div>
            </div>
        </section>
        <section class="py-4 py-xl-5 pt-lg-0 my-lg-0 pt-xxl-0 pb-xxl-5 mb-lg-0 pb-lg-5 mb-xxl-0" style="padding: 0px 0px;height: 252.4px;padding-top: 10px;margin-top: 0px;padding-bottom: 87px;margin-bottom: -64px;">
            <div class="container" style="padding: 0px;">
                <div class="text-white bg-primary border rounded border-0 border-primary d-flex flex-column justify-content-between flex-lg-row p-4 p-md-5" style="border: 2px solid #6c757d;box-shadow: 4px 6px #6c757d;">
                    <div class="order-last pb-2 pb-lg-1">
                        <h2 class="fw-bold mb-2">5 Feedbacks from yesterday's patients</h2>
                        <p class="mb-0">Click the button on the right to see.</p>
                    </div>
                    <div class="my-2"><a class="btn btn-light fs-5 py-2 px-4" role="button" href="#" style="background: var(--bs-secondary);color: #fbfff1;border-style: none;">Button</a></div>
                </div>
            </div>
        </section>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
</body>

</html>