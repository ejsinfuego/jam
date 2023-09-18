<?php 
$title = "Add Services";
include_once(__DIR__ . '/../_header_v2.php');

include '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::now('Asia/Kolkata');

if($_SESSION['usertype'] != 'd'){
    header('location: ../something_went_wrong.php');
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
                                            <h2 class="text-center mb-4" style="color: #6c757d;">Add Services</h2>
                                            <h6 class="text-center mb-4" style="font-family: Alexandria, sans-serif;color: #6c757d;margin: -19px;">Fill out necessary information.</h6>
                                            <form method="post" action="addServiceScript.php">
                                                <div class="mb-3"><label class="form-label">Service</label>
                                                <input class="form-control" type="text" id="name-2" name="service_name" placeholder="Service Name" required="">
                                                <label class="form-label" style="padding-top: 0px;margin-top: 8px;">Price</label>
                                                <input class="form-control" type="number" id="name-1" name="price" placeholder="price"></div><label class="form-label">Description</label>
                                                <textarea class="form-control" id="name-3" name="description" placeholder="What the service is all about." required=""></textarea>
                                                <div class="mb-3"></div>
                                                <div><button class="btn btn-primary d-block w-100" type="submit">Save</button></div>
                                            <div><a class="btn d-block w-100 mt-2" href="services.php">Cancel</a></div>
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
<?php include(__DIR__ . '/../_footer.php'); ?>