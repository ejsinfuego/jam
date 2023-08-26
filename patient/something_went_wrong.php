<?php
$title = "Sorry";
include(__DIR__ .'/../_header_v2.php');

(isset($_SESSION['last_page']) ? $lastpage = $_SESSION['last_page'] : $lastpage = 'index.php');

?>
            <div class="col d-flex d-xxl-flex flex-row justify-content-xxl-center align-items-xxl-center">
                <section class="py-4 py-xl-5">
                    <div class="container h-100">
                        <div class="row h-100" style="font-family: Alexandria, sans-serif;">
                            <div class="col-xxl-12 d-lg-flex justify-content-lg-center"><img src="../assets/img/sad_tooth.png" style="width: 250px;"></div>
                            <div class="col-md-10 col-xl-8 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-lg-center justify-content-xl-center">
                                <div class="text-center">
                                    <h2 class="text-uppercase fw-bold mb-3">It's not you, it's me.</h2>
                                    <p class="mb-4">We had some issues but we're already working on it.</p><a href="<?php echo $lastpage; ?>" class="btn btn-primary fs-5 me-2 py-2 px-4" type="button">Go Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
<?php include(__DIR__ .'/../_footer.php'); ?>