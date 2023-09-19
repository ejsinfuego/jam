<?php 
$title = "Check Appointment";
include_once(__DIR__ . '/../_header_v2.php');



//query that also gets the first and last name of the patient and inner join it in appointments table

$result = $database->query("SELECT appointments.id, appointments.appointmentDate, appointments.appointmentTime, appointments.service_id, appointments.created_at, patient.first_name, patient.last_name, services.service FROM appointments INNER JOIN patient ON appointments.patient_id = patient.id INNER JOIN services ON appointments.service_id = services.id WHERE appointments.patient_id = '$userid' AND appointments.cancel_details = ' ';");

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
        $('.cancelButton').click(function(){
            $('#cancelModal').modal('show');
        });
    });

    function cancelAppointment(id){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                location.reload();
            }
        };
        //post method of ajax
        xhttp.open("POST", "cancelAppointment.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id="+id+"&cancel_details="+document.getElementById('cancel_details').value);
    }

    function editAppointment(id){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                location.reload();
            }
        };
        xhttp.open("GET", "editAppointment.php?id="+id, true);
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
                                <th>Booked Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- This scripts loops and get all the appointments of the patient -->
                        <?php foreach($appointments as $appointment): ?>
                            <tr>
                                <td><?php echo $appointment['first_name']." ".$appointment['last_name'] ?></td>
                                <form class="d-flex justify-content-center flex-wrap my-2" method="post" action="deleteAppointment.php">
                                <td><?php echo $appointment['service'];?></td>
                                <td><?php echo date('M-d-Y', strtotime($appointment['appointmentDate'])); ?></td>
                                <td><?php echo date('h:i A', strtotime($appointment['appointmentTime'])); ?></td>
                                <td><?php echo date('m-d-y h:i A', strtotime($appointment['created_at'])); ?></td>
                                <td class="d-lg-flex">
                                    <a href="edit_appointment.php" class="btn btn-primary btn-sm" type="button" style="background: #2ecc71;border-style: none;">Update</a>
                                    <button class="cancelButton btn btn-outline-danger btn-sm" type="button" style="border-style: none; margin-left: 10px;">Cancel</button>
                                    <input type="checkbox" name="appointment_ids[]" value="<?php echo $appointment['id']; ?>" style="margin-left: 20px;">
                                    <div id="cancelModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <p>We will be glad to know why you will cancel.</p>
                                                    <label for="cancel_details">Reason for cancellation :</label>
                                                    <textarea type="text" name="cancel_details" id="cancel_details" class="form-control">
                                                    </textarea>

                                                </div>
                                                    <div class="modal-footer">
                                                        <button onclick="cancelAppointment(<?php echo $appointment['id']; ?>)" class="btn btn-danger btn-sm" type="button" style="border-style: none; margin-left: 10px;">Submit</button>
                                                        <button class="btn btn-secondary btn-sm" type="button" style="border-style: none; margin-left: 10px;" data-bs-dismiss="modal">Close</button>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        $_SESSION['appointment_id'] = $appointment['id'];
                     endforeach; ?>
                    </table>    
                </div>
                <section class="py-4 py-xl-5" style="font-family: Alexandria, sans-serif;">
                    <div class="container">
                    <label class="my-2">This will delete all the rows that are checked.</label>
                            <div class="my-2"><input value="Delete" name="delete" class="btn btn-danger ms-sm-2" type="submit"></input></div>
                    </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
    
<?php include_once('../_footer.php'); ?>