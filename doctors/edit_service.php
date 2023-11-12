<?php 
$title = "Add Services";
include_once(__DIR__ . '/../_header_v2.php');

include '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::now('Asia/Kolkata');

if($_SESSION['usertype'] != 'd'){
    header('location: ../something_went_wrong.php');
}
if(isset($_GET['id'])){
    $service_id = $_GET['id'];
    $services = $database->query("select * from services where id='$service_id'");
    $service = $services->fetch_assoc();
   
    
}
if($_POST){
    //code to update service from this client side-script.
    (isset($_POST['service_name']) && $_POST['service_name'] != '') ? $new_name = $_POST['service_name'] : $new_name = $service['service'];
    (isset($_POST['price']) && $_POST['price'] != '') ? $new_price = $_POST['price'] : $new_price = $service['price'];
    (isset($_POST['description']) && $_POST['description'] != '') ? $new_description = $_POST['description'] : $new_description = $service['description'];

    $updateService = $database->query("update services set service='$new_name', price='$new_price', description='$new_description', updated_at='$today' where id='$service_id'");
    $_SESSION['message'] = 'Service was updated.';
    header('location: services.php');
}
?>
            <div class="col">
                <div class="row d-md-flex d-lg-flex justify-content-md-center justify-content-lg-center" style="border-radius: 6px;margin-left: 6px;background: var(--bs-tertiary-bg);box-shadow: 5px 5px var(--bs-primary-border-subtle);border: 2px solid var(--bs-primary-border-subtle);border-bottom-style: none;border-bottom-color: #1abc9c;">
                    <section class="position-relative py-4 py-xl-5">
                        <div class="container position-relative">
                            <div class="row d-flex justify-content-center" style="margin-top: -14px;">
                                <div class="col-md-8 col-lg-11 col-xl-5 col-xxl-6">
                                    <div class="card mb-5">
                                        <div class="card-body p-sm-5" style="font-family: Alexandria, sans-serif;box-shadow: 3px 3px var(--bs-primary-border-subtle);border-radius: 6px;">
                                            <h2 class="text-center mb-4" style="color: #6c757d;">Edit Service</h2>
                                            <h6 class="text-center mb-4" style="font-family: Alexandria, sans-serif;color: #6c757d;margin: -19px;">Fill out necessary information.</h6>
                                            <form method="post">
                                                <div class="mb-3"><label class="form-label">Service</label>
                                                <input class="form-control" type="text" id="name-2" name="service_name" placeholder="<?php echo $service['service']; ?>" value="">
                                                
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control" id="name-3" name="description" placeholder="<?php echo $service['description']; ?>"></textarea>
                                                <div class="mb-3"></div>
                                                <div><button class="btn text-white d-block w-100" style="background-color:#1abc9c;" type="submit">Save</button></div>
                                                <div><a class="btn btn-primary d-block w-100 mt-2" href="services.php">Cancel</a></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
<?php include_once(__DIR__ . '/../_footer.php'); ?>