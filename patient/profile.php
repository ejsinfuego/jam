<?php

$title = 'Profile';
include_once(__DIR__ . '/../_header_v2.php');

if ($_SESSION['usertype'] == ' ') {
    header('location: ../login-1.php');
    exit;
}


$result = $database->query("SELECT * FROM patient WHERE id = '$userid'");

if ($result->num_rows > 0) {
    $patient = $result->fetch_assoc();
} else {
    $patient = [];
}

?>
<script>
    $(document).ready(function(){
        $('#sex').click(function(){
            $('#sex').empty();
            var male = "<option class='childs' value='male'>Male</option>";
            var female = "<option class='child' value='female'>Female</option>";
            $('#sex').append(male, female);

        });
    });
    
</script>
<div class="col">
    <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" style="">
            <div class="card h-100" style="font-family: Alexandria, sans-serif;border-radius: 6px;box-shadow: 2px 2px var(--bs-primary-border-subtle);border: 2px solid var(--bs-primary-border-subtle);width: auto;">
                <div class="card-body">
                    <div class="account-settings">
                        <div class="user-profile">
                            <div class="user-avatar d-flex flex-wrap"><img style="border: 1px solid gray; border-radius: 5px;" class="w-100" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Maxwell Admin" /></div>
                            <h5 class="text-center py-2">
                                <?php echo $patient['first_name'] . " " . $patient['last_name']; ?>
                            </h5>
                            <h6 class="py-1"><?php echo $patient['email']; ?></h6>
                        </div>
                        <div class="about">
                            <p style="font-size: 15px;">Recent Appointment</p>
                            <p>I&#39;m Yuki. Full Stack Designer I enjoy creating user-centric, delightful and human experiences.</p>
                        </div>
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
                            <div class="form-group"><label for="fullName">First  Name</label><input id="fullName" class="form-control" type="text" placeholder="<?php echo $patient['first_name']; ?>" /></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="fullName">Last Name</label><input id="fullName" class="form-control" type="text" placeholder="<?php echo $patient['last_name']; ?>" /></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="eMail">Email</label><input id="eMail" class="form-control" type="email" placeholder="<?php echo $patient['email']; ?>"/></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="phone">Phone</label><input id="phone" class="form-control" type="text" placeholder="<?php echo $patient['contact_number']; ?>" /></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="phone">Sex</label>
                            <select id="sex" class="form-control" type="text" placeholder="<?php echo $patient['sex']; ?>">
                            <option aria-placeholder="<?php echo $patient['sex']; ?>" value="<?php echo $patient['sex']; ?>"></option><?php echo $patient['sex']; ?></option>
                            </select>
                            </div>
                        </div>

                    </div>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mb-2 text-primary">Dental Records</h6>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="fullName">Tooth Extracted</label><input id="fullName" class="form-control" type="text" placeholder="<?php echo $patient['first_name']; ?>" /></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="fullName">Last Name</label><input id="fullName" class="form-control" type="text" placeholder="<?php echo $patient['last_name']; ?>" /></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="eMail">Email</label><input id="eMail" class="form-control" type="email" placeholder="<?php echo $patient['email']; ?>"/></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="phone">Phone</label><input id="phone" class="form-control" type="text" placeholder="<?php echo $patient['contact_number']; ?>" /></div>
                        </div>
                       
                    </div>
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
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex">
                            <div class="text-right"><button id="submit" class="btn" style="background: #1abc9c;border-style: none;color: rgb(213,219,219); color: white;" type="button" name="submit">Dental Records</button><button id="submit" class="btn btn-primary mx-3" type="button" name="submit">Update</button></div>
                        </div>
                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex py-3">
                            <div class="text-right"><button id="submit" class="btn" style="background: #1abc9c;border-style: none;color: rgb(213,219,219); color: white;" type="button" name="submit">Change Password</button></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once(__DIR__ . '/../_footer.php'); ?>
