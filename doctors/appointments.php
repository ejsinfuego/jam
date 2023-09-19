<?php 
$title = "Check Appointment";
include_once(__DIR__ . '/../_header_v2.php');

if($_SESSION['usertype'] != 'd'){
    header('location: ../something_went_wrong.php');
    exit;
}

$result = $database->query("SELECT appointments.id, appointments.appointmentDate, appointments.cancel_details,appointments.appointmentTime, appointments.status, appointments.service_id, appointments.created_at, patient.first_name, patient.last_name, services.service FROM appointments INNER JOIN patient ON appointments.patient_id = patient.id INNER JOIN services ON appointments.service_id = services.id");

//get all the appointments of patient by 10

if($result->num_rows>0){
    $appointments = $result->fetch_all(MYSQLI_ASSOC);
    $appointments = array_chunk($appointments, 10);
    $appointments = $appointments[0];
}else{
    $appointments = [];
}

?>
<script>
    $(document).ready(function(){

        $('#myModal').modal('show');
        $('.cancelButton').click(function(){
        $('#myModal').modal('show');
    });
    });

    function approveAppointment(id){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                location.reload();
            }
        };
        xhttp.open("GET", "approveAppointment.php?id="+id, true);
        xhttp.send();
    }

    function deleteAppointment(appointment_id){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                location.reload();
            }
        };
        xhttp.open("GET", "deleteAppointment.php?appointment_id="+appointment_id, true);
        xhttp.send();
    }
</script>
<div class="col">
        <h2 class="d-lg-flex justify-content-lg-center" style="font-family: Alexandria, sans-serif;">Appointments</h2>
                <div class="table-responsive" style="font-family: Alexandria, sans-serif;">
                <table id="sortTable" class="table table-striped table-striped-columns table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Date Booked</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- This the block where it displays all the appointments of all the patient -->
                            <?php foreach($appointments as $appointment) : ?>
                        <tr>
                                <td><?php echo $appointment['first_name']." ".$appointment['last_name'] ?></td>
                                <form class="d-flex justify-content-center flex-wrap my-2" method="post" action="deleteAppointment.php">
                                <td><?php echo $appointment['service'];?></td>
                                <td><?php echo date('M-d-Y', strtotime($appointment['appointmentDate'])); ?></td>
                                <td><?php echo date('h:i A', strtotime($appointment['appointmentTime'])); ?></td>
                                <td><?php echo ($appointment['status'] != null) ? $appointment['status'] : 'Pending'; ?></td>
                                <td><?php echo date('M-d-Y', strtotime($appointment['created_at'])); ?></td>
                                <td class="d-lg-flex justify-content-lg-start">
                                    <?php if($appointment['status'] == null) : ?>
                                    <button onclick="approveAppointment(<?php echo $appointment['id']; ?>)" class="btn btn-primary btn-sm" type="button" style="background: #2ecc71;border-style: none;">Approve</button>
                                    <?php endif; ?>
                                    <button onclick="deleteAppointment(<?php echo $appointment['id']; ?>)" class="btn btn-outline-danger btn-sm" 
                                    type="button" style="border-style: none; margin-left: 10px;">Delete</button></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
<?php include(__DIR__ . './../_footer.php'); ?>