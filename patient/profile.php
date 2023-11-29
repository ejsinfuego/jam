<?php

$title = 'Profile';
include(__DIR__ . '/../_header_v2.php');

if ($_SESSION['usertype'] != 'p') {
    header('location: ../login-1.php');
}

$result = $database->query("SELECT * FROM patient WHERE id = '$userid'");

if ($result->num_rows > 0) {
    $patient = $result->fetch_assoc();
} else {
    $patient = [];
}

$records = $database->query("SELECT * FROM records INNER JOIN appointments ON records.appointment_id = appointments.id INNER JOIN tooth ON records.tooth_id = tooth.id WHERE patient_id = '$userid'");

?>
<script>
    $(document).ready(function(){
        $('#teethTable').DataTable({
        paginate: false,
    });
    });
    
    function viewDetails(appointmentDate, appointmentTime, service){
        $('#my-modal').modal('show');
        $('#appDate').html(appointmentDate);
        $('#appTime').html(appointmentTime);
        $('#service').html(service);

    }
    $(document).ready(function(){
        $('#sex').click(function(){
            $('#sex').empty();
            var male = "<option class='childs' value='male'>Male</option>";
            var female = "<option class='child' value='female'>Female</option>";
            $('#sex').append(male, female);

        });

        $('#pwreset').click(function(){
            $('#changePassword').modal('show');
        });
    });
   
    function updateProfile(id){
        
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                alert(this.responseText);
            }
        };
        xhttp.open("POST", "updateProfile.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id="+id);

    }
</script>
<style>
    .form-control{
        font-family: Inter, sans-serif;
    }
</style>
<div id="changePassword" class="modal fade p-5" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content p-5">
                <div class="modal-body">
                <div>
                <h2 class="text-center mb-4" style="color: #6c757d;">Change Password</h2>
                <hr class="border-2 border-black">
                </div>
                <form method="post" action="changePassword.php">
                <label for="oldPassword">Old Password</label>
                <input type="password" class="form-control" name="oldPassword" id="oldPassword"/>
                <label for="newPassword">New Password</label>
                <input type="password" class="form-control" name="newPassword" id="newPassword"/>
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword"/>
                <input type="hidden" name="id" value="<?php echo $userid; ?>">
                <div class="pt-4">
                <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card h-100 p-4" style="font-family: Alexandria, sans-serif;border-radius: 6px;box-shadow: 2px 2px var(--bs-primary-border-subtle);border: 2px solid var(--bs-primary-border-subtle);width: auto;">
                <div class="card-body">
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mb-2 text-primary">Personal Details</h6>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <form method="post" action="editProfile.php">
                        <div class="form-group"><label for="fullName">First  Name</label>
                        <input type="hidden" name="id" value="<?php echo $patient['id']; ?>">
                        <input  name="first_name" id="fullName" class="form-control" type="text" placeholder="<?php echo $patient['first_name']; ?>" /></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="fullName">Last Name</label><input id="fullName" name="last_name" class="form-control" type="text" placeholder="<?php echo $patient['last_name']; ?>" /></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="eMail">Email</label><input name="email" id="eMail" class="form-control" type="email" placeholder="<?php echo $patient['email']; ?>"/></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="phone">Phone</label><input id="phone" class="form-control" name="contact_number" type="text" placeholder="<?php echo $patient['contact_number']; ?>" /></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="dob">Date of Birth</label><input id="phone" class="form-control" name="dob" type="date" value="<?php echo $patient['dob']; ?>" /></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="phone">Sex</label>
                            <select name="sex" id="sex" class="form-control" type="text" placeholder="<?php echo $patient['sex']; ?>">
                            <option aria-placeholder="<?php echo $patient['sex']; ?>" value="<?php echo $patient['sex']; ?>"><?php echo ucfirst($patient['sex']); ?></option>
                            </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="phone">Address</label><textarea id="phone" class="form-control" name="address" type="date" placeholder="<?php echo $patient['address'] ?? 'Address not set'; ?>"><?php echo $patient['address'] ?? 'Address not set'; ?></textarea></div>
                        </div>
                            <div class="text-start">
                            <button id="submit" class="btn btn-outline-info btn-sm my-3" type="submit" name="submit">Update</button></div>
                        </div>
                        
                    </form>
                    </div>                    
                    <div class="row gutters">
                            <div class="text-start"><a href="#dentalRecords" id="submit" class="btn btn-sm" style="background: #1abc9c;border-style: none;color: rgb(213,219,219); color: white;" type="button" name="submit">Dental Records</a>
                            <div class="text-start my-3"><button id="pwreset" class="btn btn-sm btn-secondary" type="button" name="submit">Change Password</button></di>
                </div>
                <div id="dentalRecords" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mb-2 text-primary">Dental Records</h6>
                    </div>
                    <div class="d-flex">
                        <table id="teethTable" class="table table-bordered table-sm table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">Tooth Name</th>
                                    <th scope="col">Tooth Number</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($records as $record): ?>
                                    <?php $service = $database->query('select service from services where id = '.$record['service_id'].'');
                                    $service = $service->fetch_column(); ?>
                                <tr>
                                    <td><?php echo $record['tooth_name']; ?></td>
                                    <td><?php echo $record['tooth_number']; ?></td>
                                    <td>
                                        <button onclick="viewDetails('<?php echo $record['appointmentDate']; ?>', '<?php echo date('h:i A', strtotime($record['appointmentTime'])); ?>', '<?php echo $service; ?>')" class="btn btn-sm btn-primary">View Details</button>
                                    </td>
                                    <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="false">
                                        <div class="modal-dialog" role="document">
                                        <form method="get" action="generateReport.php">
                                            <div class="modal-content p-4">
                                                <div class="modal-body">
                                                    <label>Appointment Date</label>
                                                    <input type="hidden" id="appointment_id" name="appointment_id" value="<?php echo $record['appointment_id']; ?>">
                                                    <p class="form-control" id="appDate"><?php echo $record['appointmentDate'];?></p>
                                                    <label>Appointment Time</label>
                                                    <p class="form-control" id="appTime"></p>
                                                    <label>Service</label>
                                                    <p class="form-control" id="service"><?php echo $service; ?></p>
                                                    <label>Prescription</label>
                                                    <textarea class="form-control" id="service" readonly><?php echo $record['prescription']; ?></textarea>
                                                    <label>Feedback</label>
                                                    <textarea class="form-control" id="service" readonly><?php echo $record['feedback']; ?></textarea>
                                                </div>
                                                <div class="pt-3">
                                                        <button class="btn btn-outline-info"
                                                        type="submit">Generate Report
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <!-- <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mb-2 text-primary">Dental Records</h6>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="fullName">Tooth Extracted</label><input id="fullName" class="form-control" type="text" placeholder="<?php echo $patient['fname']; ?>" /></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="fullName">Last Name</label><input id="fullName" class="form-control" type="text" placeholder="<?php echo $patient['lname']; ?>" /></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="eMail">Email</label><input id="eMail" class="form-control" type="email" placeholder="<?php echo $patient['email']; ?>"/></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="phone">Phone</label><input id="phone" class="form-control" type="text" placeholder="<?php echo $patient['contact_number']; ?>" /></div>
                        </div>
                       
                    </div> -->
                    <!-- <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mt-3 mb-2 text-primary">Address</h6>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="Street">Street</label><input id="Street" class="form-control" type="name" placeholder="Enter Street" /></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="ciTy">Barangay</label><input id="ciTy" class="form-control" type="name" placeholder="Enter City" /></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="sTate">Town</label><input id="sTate" class="form-control" type="text" placeholder="Enter State" /></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="zIp">Zip Code</label><input id="zIp" class="form-control" type="text" placeholder="Zip Code" /></div>
                        </div>
                    </div> -->

            </div>
        </div>
    </div>
</div>
<?php include(__DIR__ . '/../_footer.php'); ?>
