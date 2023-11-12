<?php 
$title = "Check Patients";
include_once(__DIR__ . '/../_header_v2.php');

if($_SESSION['usertype'] != 'd'){
    header('location: ../login-1.php');
    exit;
}



$result = $database->query("SELECT * from appointments inner join patient on appointments.patient_id = patient.id");

//get all the appointments of patient



//get all the appointments of patient by 10
if($result->num_rows > 0){
    $appointments = $result->fetch_all(MYSQLI_ASSOC);
    $appointments = array_chunk($appointments, 10);
    $appointments = $appointments[0];
}else{
    $appointments = [];
}
// $schedules = $database->query("SELECT patient.id, appointments.appointmentDate from patient INNER JOIN appointments on patient.id = appointments.patient_id where patient.id = $appointments['id']");
?>
<style>
    #name:hover{
        color: #2ecc71;
    }
</style>
<script>
    function viewPatient(id){
       var xhttp = new XMLHttpRequest();
         xhttp.onreadystatechange = function() {
              if(this.readyState == 4 && this.status == 200){
                window.location.href = "profile.php?id="+id;
              }
         };
              xhttp.open("GET", "profile.php?id="+id, true);
              xhttp.send();
         };
</script>
            <div class="col">
            <h2 class="d-lg-flex justify-content-lg-center" style="font-family: Alexandria, sans-serif;margin-bottom: 20px;margin-top: 20px;text-shadow: 3px 2px #abb2b9;">Patients</h2>

                <div class="table-responsive" style="font-family: Inter, sans-serif;">
                    <table class="table table-striped table-striped-columns table-hover table-sm" id="sortTable">
                        <thead>
                            <tr>
                                <th>Complete Name</th>
                                <th>Email</th>
                                <th>Sex</th>
                                <th>Contact Number</th>
                                <!-- <th>Date Booked</th> -->
                                <!-- <th></th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($appointments as $appointment): ?>
                            <tr class="table-hover">
                          
                                <td id="name" style="cursor: pointer;"
                                onclick="viewPatient(<?php echo $appointment['id']; ?>)">
                                <?php echo $appointment['first_name']." ".$appointment['last_name'] ?>
                                </td>
                                <form class="d-flex justify-content-center flex-wrap my-2" method="post" action="deleteAppointment.php">
                                <td><?php echo $appointment['email'];?></td>
                                <td><?php echo ucfirst($appointment['sex'] ?? 'Not Set'); ?>
                                </td>
                                <td><?php echo ($appointment['contact_number']) ?? 'Not Set'; ?>
                                </td>
                                <!-- <td class="d-lg-flex justify-content-lg-center">
                                    <a href="edit_appointment.php" class="btn btn-danger btn-sm" type="button" style="background: #2ecc71;border-style: none;">Update</a> -->
                                    <!-- <a href="cancellation.php" class="btn btn-danger btn-sm" type="button" style="background: #2ecc71;border-style: none; margin-left: 10px;">Cancel</a> -->
                            </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
<?php include('../_footer.php'); ?>