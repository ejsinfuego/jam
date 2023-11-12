<?php 

$title = 'Book Appointment';

require '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::today();

include(__DIR__ . '/../_header_v2.php');

if(isset($_GET['serviceName'])){
    $available = $database->query('select appointmentDate, appointmentTime, resched_details, cancel_details from appointments where cancel_details = "" and service_id = '.$_GET['serviceName'].';');
    $availableDates = $available->fetch_assoc();
    $serviceName = $database->query('select * from services where id = '.$_GET['serviceName'].';')->fetch_assoc();
}else{
    $available = $database->query('select appointmentDate, appointmentTime, resched_details, cancel_details from appointments where cancel_details = ""');
    $availableDates = $available->fetch_assoc();
}



$dateTaken = Carbon::today();
$timeTaken = Carbon::today();
$date = date_format($dateTaken, "j");
$time = date_format($timeTaken, "h:sa");


$daysInMonth = $today->daysInMonth;

$firstDay = $today->copy()->startOfMonth(); // Clone the original $firstDay for reuse

// Get days in this month
$days = [];

for ($i = 1; $i <= $daysInMonth; $i++) {
    $days[] = $firstDay->copy()->addDay($i - 1)->format('j');
}

//get days of the week
$daysOfWeek = [
    'Sun',
    'Mon',
    'Tues',
    'Wed',
    'Thurs',
    'Fri',
    'Sat',
];

$services = $database->query("select id, service from services;");
$availableServices = $services->fetch_assoc();

?>
<script>
    $(document).ready(function(){
        $('.appointmentDate').click(function(date){
            $('#appointment').modal('show');

        })
    
    });

</script>
<style>
    .appointmentDate:hover{
        background-color: #1abc9c;
        color: white;
    }
    .appointmentDate:hover h5{
        color
    }
</style>

<div id="appointment" style="font-family: Alexandria, sans-serif;border-radius: 6px; box-shadow: 2px 2px var(--bs-primary-border-subtle); border: 2px solid var(--bs-primary-border-subtle);" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-5">
            
            <h2 class="text-center mb-4" style="color: #6c757d;">Book an appointment</h2>
            
                <h6 class="text-center mb-4">Choose the date and time to book an appointment.</h6>
                <form method="post" action="submitConsultation.php">
                    <div class="mb-3"><label class="form-label">Date</label>
                    <input class="form-control" id="name-2" name="date" placeholder="Date" type="date" min="<?php echo $today->toDateString(); ?>"><label class="form-label" style="padding-top: 0px;margin-top: 8px;">Time</label>
                    <input class="form-control" id="name-1" name="time" placeholder="Name" type="time" min="09:00" max="18:00"></div>
                    <label class="form-label">Type</label>
                    <div class="dropdown bg-light-subtle d-flex justify-content-xxl-start text-align-left" style="width: auto;">
                    <select class="btn dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" name="type" type="button">
                    <div class="dropdown-menu text-align-left">
                    <?php foreach($services as $availableServices) : ?>
                    <option class="dropdown-item text-align-left" value="<?php echo $availableServices['id']; ?>"><?php echo $availableServices['service']; ?></option>
                    <?php endforeach; ?>
                    </div>
                    </select>
                    <input type="hidden" value="<?php echo $userid; ?>" name="patient_id">
                    </div>
                    <div class="mb-3"></div>
                    <div><button class="btn btn-primary d-block w-100" type="submit">Book</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-2"></div>
<div class="col-8" style="font-family: Alexandria, sans-serif; color: #6c757d; background-image: url('./assets/img/back_ground.jpg');">
<h2 class="d-lg-flex" style="font-family: Alexandria, sans-serif; color: #6c757d;">Calendar of Scheduled Appointment</h2>
<p class="ms-5 ps-4 text-align-center">Click the dates of the calendar to book an
appointment <br>
<?php if(isset($_GET['serviceName'])) : ?>
    <span style="margin: 35px;">Showing appointments for <?= $serviceName['service'] ?></span>
<?php endif; ?></p>

<p class="ms-5 ps-4" style="font-size: 15px; font-style:normal;">
<div class="container ms-5 ps-5">
        <div class="d-xxl-flex">
        <div class="row d-flex d-xxl-flex align-content-center align-self-center flex-wrap" style="font-family: Alexandria, sans-serif;">
            <div class="d-flex flex-wrap">
            <div class="col-7" style="background: #1abc9c;color: #f1f0f0;">
                <h1 class="text-center" style="font-family: Alexandria, sans-serif;"><?php echo $today->format('F Y') ?></h1>
            </div>
            <div class="col-5"></div>
            </div>
            <div class="d-flex d-xxl-flex flex-wrap">
            <?php foreach ($days as $day) :?>
            <?php if ($day == 8 or $day == 15 or $day == 22 or $day == 29) : ?>
            <div class="d-flex flex-wrap w-100"></div>
            <?php endif; ?>
            <a class="appointmentDate col-md-3 col-lg-1 col-xxl-1 d-flex justify-content-lg-start flex-column" style="border: 1.4px none #1abc9c;border-top-style: none;border-top-color: var(--bs-gray-500);border-right-style: solid;border-right-color: var(--bs-primary-border-subtle);border-bottom-style: solid;border-bottom-color: var(--bs-primary-border-subtle);border-left-style: solid;border-left-color: var(--bs-primary-border-subtle);color: var(--bs-gray-600); cursor: pointer">
                    <h5 class="text-start d-xxl-flex flex-row align-content-center align-self-center flex-wrap pt-lg-0" style="font-size: 11px;margin-top: 11px;color: #6c757d;padding-left: 0px;margin-left: -4px;width: 100%;"><?php echo $day; ?></h5>
                    <h5 class="text-start d-xxl-flex flex-row align-content-center align-self-center flex-wrap pt-lg-0 pt-xxl-0" style="font-size: 11px;color: white; padding-left: 0px;margin-left: -4px;width: auto;margin-top: -2px; background-color:#1abc9c;">
                    <?php foreach ($available as $availableDates) : ?>
                    <?php
                    if($availableDates['resched_details'] != ''){
                        if($availableDates['resched_details'] == $today->format('Y-m-').$day){
                            echo date('h:ia', strtotime($availableDates['appointmentTime']));
                        }
                    }else{
                        if($availableDates['appointmentDate'] == $today->format('Y-m-').$day){
                            echo date('h:ia', strtotime($availableDates['appointmentTime']));
                        }
                        
                    } 
                    ?>
                    <?php endforeach; ?>
                </h5>
            </a>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-2"></div>
<?php include(__DIR__ . '/../_footer.php'); ?>