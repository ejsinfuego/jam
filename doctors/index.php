<?php 
use Carbon\Traits\ToStringFormat;

session_start();

$title = 'Index';

include('../connection.php');

include '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::now('Asia/Kolkata')->format('Y-m-d');


//get the name of user
$name = $database->query("SELECT * FROM doctor WHERE id = {$_SESSION['id']}")->fetch_assoc();

$appointments = $database->query("SELECT * FROM appointments WHERE cancel_details=''")->fetch_all();
$appointmentsToday = count($database->query("SELECT * FROM appointments WHERE appointmentDate = '$today'")->fetch_all());

$patients = $database->query("SELECT * FROM patient")->fetch_all();
$services = $database->query("SELECT * FROM services")->fetch_all();
$events = count($database->query("SELECT * FROM events")->fetch_all());

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

<body style="font-family: Alexandria, sans-serif;background: #fbfff1; background-image: url('../assets/img/main_bg.png'); background-size: 400px 200px; background-attachment: fixed;">
 <div class="container" style="margin-top: 1rem;">
    <div class="row df-l mb-3">
        <nav class="col navbar d-flex navbar-expand-md bg-body d-flex d-xxl-flex flex-row justify-content-center align-items-center justify-content-xxl-center align-items-xxl-center rubberBand animated py-3" style="background: rgb(44,62,80);font-family: Alexandria, sans-serif;border-radius: 6px;box-shadow: 2px 2px var(--bs-primary-border-subtle);border: 2px solid var(--bs-primary-border-subtle);width: auto;">
            <div class="container-fluid"><a class="navbar-brand d-flex align-items-center" href="index.php"><img src="../assets/img/logo.png" width="54" height="54" /><span class="d-flex px-sm-4" style="color: var(--bs-gray-600);font-size: 18px;text-shadow: 1px 1px #1abc9c;margin-left: -19px;margin-right: -19px;">Orfanel-Mendoza Dental Clinic</span></a><button class="navbar-toggler" data-bs-toggle="collapse"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button></div>
    </nav>
    </div>
    <div class="container" style="padding: 0px;">
        <section class="text-white">
            <div class="container" style="padding: 0px;">
                <div class="border rounded border-0 d-flex flex-column justify-content-center align-items-center p-4 py-5" style="background: linear-gradient(rgba(0,123,255,0.2) 0%, rgba(0,123,255,0.2) 84%, rgb(44,62,80) 100%), url(&quot;../assets/img/bg.png&quot;) center / cover;height: 121px;box-shadow: 5px 5px var(--bs-primary-border-subtle);border: 2px solid var(--bs-gray-500);border-bottom: 2px none #abb2b9;">
                    <div class="row d-flex d-xxl-flex">
                        <div class="col-md-10 col-xl-8 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                            <div>
                                <h1 class="text-uppercase fw-bold bounce animated mb-3" style="text-shadow: -3px 4px #1abc9c;padding-bottom: 0px;margin-top: 15px;margin-bottom: 15px;">welcome,
                            <?php echo $name['first_name']; ?></h1>
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
                        <p class="mb-0">Appointment/s</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col">
            <a href="check_patients.php" class="text-decoration-none text-body">
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
            </a>
            </div>
            <div class="col">
            <a href="services.php" class="text-decoration-none text-body">

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
            </a>
            </div>
            <div class="col">
            <a href="events.php" class="text-decoration-none text-body">
                <div class="text-center d-flex flex-column justify-content-center align-items-center py-3" style="border-style: solid;border-color: #6c757d;border-radius: 6px;box-shadow: 4px 3px #6c757d;">
                    <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg"><i class="material-icons" style="font-size: 38px;">rss_feed</i></div>
                    <div class="px-3">
                        <h2 class="fw-bold mb-0"><?php echo $events; ?></h2>
                        <p class="mb-0">Events</p>
                    </div>
                </div>
            </a>
            </div>
        </div>
    </div>
    <div class="container position-relative" style="padding-right: 0px;padding-left: 0px;">
        <section class="py-4 py-xl-5 pt-xxl-0 pt-lg-0 my-lg-0 mb-lg-0" style="padding: 0px 0px;height: 194.4px;margin-bottom: -20px;">
            <div class="text-white bg-primary border rounded border-0 border-primary d-flex flex-column justify-content-between flex-lg-row p-4 p-md-5" style="border: 2px solid #6c757d;box-shadow: 4px 6px #6c757d;padding: 48px;">
                <div class="pb-2 pb-lg-1">
                    <h2 class="fw-bold mb-2"><?php echo $appointmentsToday; ?> Appointment/s today.&nbsp;</h2>
                    <p class="mb-0">Click the button on the right to see.</p>
                </div>
                <div class="my-2"><a class="btn btn-light fs-5 py-2 px-4" role="button" href="appointments.php" style="background: var(--bs-secondary);color: #fbfff1;border-style: none;">Check Here</a></div>
            </div>
        </section> 
        <!-- <a href="../backup.php">Backup</a> -->
    </div>
   
<?php include('../_footer.php'); ?>