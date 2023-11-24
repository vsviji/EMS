<?php

require_once 'core/init.php';
require_once 'core/DB.php';
require_once '../includes/function.php';

$user = new Faculty();
if ($user->isLoggedIn()) {
    $data = $user->data();
    if (Input::exists('get')) {
        if (Input::get('hash')) {
            if (convert_string('encrypt', Input::get('hash')) == $data->fac_passkey) {
                $db = DB::getInstance();

?>
                <!DOCTYPE html>
                <html lang="en">
                

                <head>
                    <meta charset="utf-8" />
                    <title><?php echo $data->fac_name ?> | EMS@Faculty</title>
                    <!-- SEO Meta Tags-->
                    
                    <meta name="description" content="EMS Dashboard" />
                    <meta name="robots" content="index, follow" />
                    
                    <!-- Viewport-->
                    <meta name="viewport" content="width=device-width, initial-scale=1" />

                    <!-- Vendor Styles-->
                    <link rel="stylesheet" media="screen" href="../vendor/simplebar/dist/simplebar.min.css" />
                    <!-- Main Theme Styles + Bootstrap-->
                    <link rel="stylesheet" media="screen" href="../css/theme.min.css" />
                    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

                </head>
                <!-- Body-->

                <body style="background-color: #f7f7fc">

                    <main class="cs-page-wrapper">
                        <header class="cs-header navbar navbar-expand-lg navbar-dark navbar-floating navbar-sticky" data-scroll-header>
                            <div class="container px-0 px-xl-3">
                                <button class="navbar-toggler ml-n2 mr-2" type="button" data-toggle="offcanvas" data-offcanvas-id="primaryMenu">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <a class="navbar-brand order-lg-1 mx-auto ml-lg-0 pr-lg-2 mr-lg-4 font-weight-bolder" href="../index.php">EMS</a>
                                <div class="d-flex align-items-center order-lg-3 ml-lg-auto">
                                    <div class="navbar-tool dropdown">
                                        <?php if ($data->fac_image) { ?>
                                            <a class="navbar-tool-icon-box" href="account-profile.html">
                                                <img class="navbar-tool-icon-box-img" src="data:image/png;base64,<?php echo base64_encode($data->fac_image) ?>" alt="<?php echo $data->fac_name ?>" />
                                            </a>
                                        <?php } else { ?>
                                            <img src="../img/blank.png" class="navbar-tool-icon-box-img" alt="<?php echo $row->fac_name ?>">
                                        <?php } ?>

                                        <a class="navbar-tool-label dropdown-toggle" href="account-profile.html"><small>Hello,</small><?php echo $data->fac_name ?></a>
                                        <ul class="dropdown-menu dropdown-menu-right" style="width: 15rem">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center" href="index.php"><i class="fe-shopping-bag font-size-base opacity-60 mr-2"></i>My Profile<span class="nav-indicator"></span><span class="ml-auto font-size-xs text-muted"></span></a>
                                            </li>
                                            <li class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center" href="#"><i class="fe-message-square font-size-base opacity-60 mr-2"></i>Messages<span class="nav-indicator"></span><span class="ml-auto font-size-xs text-muted"></span></a>
                                            </li>
                                            <li class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center" href="#"><i class="fe-users font-size-base opacity-60 mr-2"></i>Followers<span class="ml-auto font-size-xs text-muted"></span></a>
                                            </li>
                                            <li class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center" href="logout.php"><i class="fe-log-out font-size-base opacity-60 mr-2"></i>Sign out</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="cs-offcanvas-collapse order-lg-2" id="primaryMenu">
                                    <div class="cs-offcanvas-cap navbar-box-shadow">
                                        <h5 class="mt-1 mb-0">Menu</h5>
                                        <button class="close lead" type="button" data-toggle="offcanvas" data-offcanvas-id="primaryMenu">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="cs-offcanvas-body">
                                        <!-- Menu-->
                                        <ul class="navbar-nav">
                                            <li class="nav-item">
                                                <a class="nav-link" href="index.php">Home</a>
                                            </li>
                                            <?php if ($data->fac_role == 'HOD') { ?>
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Faculty</a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="fac_overview.php?hash=<?php echo convert_string('decrypt', $data->fac_passkey) ?>">Overview</a></li>
                                                        <li class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item" href="fac_event_report.php?hash=<?php echo convert_string('decrypt', $data->fac_passkey) ?>">Event Report</a></li>
                                                    </ul>
                                                </li>
                                                <li class="nav-item dropdown active">
                                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Student</a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="fas_overview.php?hash=<?php echo convert_string('decrypt', $data->fac_passkey) ?>">Overview</a></li>
                                                        <li class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item active" href="fas_event_report.php?hash=<?php echo convert_string('decrypt', $data->fac_passkey) ?>">Event Report</a></li>
                                                    </ul>
                                                </li>
                                            <?php } else { ?>
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Faculty</a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="fac_overview.php?hash=<?php echo convert_string('decrypt', $data->fac_passkey) ?>">Overview</a></li>
                                                        <li class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item" href="fac_event_create.php?hash=<?php echo convert_string('decrypt', $data->fac_passkey) ?>">Event Participated</a></li>
                                                    </ul>
                                                </li>
                                                <li class="nav-item dropdown active">
                                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Student</a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="fas_overview.php?hash=<?php echo convert_string('decrypt', $data->fac_passkey) ?>">Overview</a></li>
                                                        <li class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item active" href="fas_event_report.php?hash=<?php echo convert_string('decrypt', $data->fac_passkey) ?>">Event Report</a></li>
                                                    </ul>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </header>
                        <!-- Page content-->
                        <!-- Slanted background-->
                        <div class="position-relative bg-gradient" style="height: 480px">
                            <div class="cs-shape cs-shape-bottom cs-shape-slant bg-secondary d-none d-lg-block">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3000 260">
                                    <polygon fill="currentColor" points="0,257 0,260 3000,260 3000,0"></polygon>
                                </svg>
                            </div>
                        </div>
                        <!-- Page content-->
                        <div class="container bg-overlay-content pb-4 mb-md-3" style="margin-top: -350px">
                            <div class="d-flex flex-column h-100 bg-light rounded-lg box-shadow-lg p-4">

                                <div class="py-1 p-md-3 mt-3  border-bottom">
                                    <!-- Title + Delete link-->
                                    <div class="d-sm-flex align-items-center justify-content-between pb-2 text-center text-sm-left">
                                        <h1 class="h3 mb-2 text-nowrap">Student Event Report</h1>
                                        <!-- Dropdown example 2 
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Export
                                        </button>
                                        <div class="dropdown-menu float-right">
                                            <h6 class="dropdown-header">Export</h6>
                                            <a href="#" class="dropdown-item" id="export_copy">Copy</a>
                                            <a href="#" class="dropdown-item" id="export_print">Print</a>
                                            <a href="#" class="dropdown-item" id="export_csv">CSV</a>
                                            <a href="#" class="dropdown-item" id="export_excel">Excel</a>
                                            <a href="#" class="dropdown-item" id="export_pdf">PDF</a>                                            
                                        </div> 
                                    </div> 
                                    -->
                                    </div>
                                    <!-- Content-->
                                </div>

                                <form method="post" id="fas_event_form">
                                    <div class="row mt-4">

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text font-weight-medium">Mentor</span>
                                                    </div>
                                                    <select class="form-control custom-select" name="e_mentor">
                                                        <option value="">Choose mentor...</option>
                                                        <?php
                                                        $fac = $db->get('em_faculty', array('fac_dept_hash', '=', $data->fac_dept_hash, 'fac_status', '=', 'Active'));
                                                        if ($fac->count()) {
                                                            foreach ($fac->results() as $row) {
                                                                echo '<option value="' . convert_string('decrypt', $row->fac_passkey) . '">' . $row->fac_name . '</option>';
                                                            }
                                                        } else {
                                                            echo '<option value="">Mentor Not Found</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <!-- Textual addon -->
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text font-weight-medium">Activity</span>
                                                    </div>
                                                    <select class="form-control custom-select" name="e_activity">
                                                        <option value="">Choose option...</option>
                                                        <option value="Paper Presentation">Paper Presentation</option>
                                                        <option value="Workshop">Workshop</option>
                                                        <option value="Courses">Courses</option>
                                                        <option value="Contest">Contest</option>
                                                        <option value="Bootcamp">Bootcamp</option>
                                                        <option value="Internship">Internship</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <!-- Textual addon -->
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text font-weight-medium">Academic Year</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="e_year" id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <!-- Textual addon -->
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text font-weight-medium">Start Date</span>
                                                    </div>
                                                    <input type="date" class="form-control" name="e_sdate" id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <!-- Textual addon -->
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text font-weight-medium">End Date</span>
                                                    </div>
                                                    <input type="date" class="form-control" name="e_edate" id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <!-- Textual addon -->
                                                <div class="form-group">
                                                    <input type="hidden" name="action" value="fas_event_search">
                                                    <input type="submit" class="btn btn-primary" name="e_submit" value="Search" id="">
                                                    <a href="#" class="ml-2 btn btn-danger" data_val="" id="export"><i class="fe-download"></i> Excel</a>
                                                    <a href="#" data_val="" class="ml-2 btn btn-primary" id="export_t"><i class="fe-download"></i> Pdf</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                                <!-- Light table with hoverable rows -->
                                <div class="table-responsive mt-4">
                                    <table class="table table-hover table-responsive" id="std_table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="min-width:250px">Students Details</th>
                                                <th style="min-width:160px">Event Name</th>
                                                <th style="min-width:180px">Activity</th>
                                                <th style="min-width:140px">Topic</th>
                                                <th style="min-width:140px">Academic Year</th>
                                                <th style="min-width:140px">Start Date</th>
                                                <th style="min-width:140px">End Date</th>
                                                <th style="min-width:100px">Venue</th>
                                                <th>Image</th>
                                                <th>Ceritificate</th>
                                            </tr>
                                        </thead>

                                        <tbody id="fas_event">

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </main>
                    <!-- Footer-->
                    <footer class="cs-footer py-4">
                        <div class="container d-md-flex align-items-center justify-content-between py-2 text-center text-md-left">
                            <ul class="list-inline font-size-sm mb-3 mb-md-0 order-md-2">
                                <li class="list-inline-item my-1"><a class="nav-link-style" href="#">Support</a></li>
                                <li class="list-inline-item my-1"><a class="nav-link-style" href="#">Contacts</a></li>
                                <li class="list-inline-item my-1"><a class="nav-link-style" href="#">Terms &amp; Conditions</a></li>
                            </ul>
                            
                        </div>
                    </footer>
                    <!-- Back to top button-->
                    <!-- Back to top button-->
                    <a class="btn-scroll-top" href="#top" data-scroll><span class="btn-scroll-top-tooltip text-muted font-size-sm mr-2">Top</span><i class="btn-scroll-top-icon fe-arrow-up">
                        </i></a>
                    <!-- Vendor scrits: js libraries and plugins -->

                    <script src="../vendor/jquery/dist/jquery.slim.min.js"></script>
                    <script src="../vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="../vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
                    <script src="../vendor/simplebar/dist/simplebar.min.js"></script>
                    <script src="../vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
                    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
                    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
                    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
                    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
                    <!--                                                                                   
                    <script>
                        $(document).ready(function() {
                            
                            var t = $("#fac_event").DataTable({
                                
                                "processing": true,
                                "serverSide": true,                                                                
                                "ajax": {
                                    url: "fac_event.php",
                                    dataType: "json",
                                    type: "POST",                                                                    
                                },
                                order: [[2, 'asc']],
                                columnDefs: [{
                                    targets: ["_all"],
                                    orderable: true
                                }],                               
                                buttons: [
                                    'print',
                                    'copyHtml5',
                                    'excelHtml5',
                                    'csvHtml5',
                                    'pdfHtml5'
                                ],
                                "pageLength": 10,
                                "responsive": true,
                                                                                                                         
                            });

                            $("#export_print").on("click", function(e) {
                                    e.preventDefault(), t.button(0).trigger()
                                }),
                                $("#export_copy").on("click", function(e) {
                                    e.preventDefault(), t.button(1).trigger()
                                }),
                                $("#export_excel").on("click", function(e) {
                                    e.preventDefault(), t.button(2).trigger()
                                }),
                                $("#export_csv").on("click", function(e) {
                                    e.preventDefault(), t.button(3).trigger()
                                }),
                                $("#export_pdf").on("click", function(e) {
                                    e.preventDefault(), t.button(4).trigger()
                                });

                                var s = $("#fas_event").DataTable({
                                
                                "processing": true,
                                "serverSide": true,                                                                
                                "ajax": {
                                    url: "fas_event.php",
                                    dataType: "json",
                                    type: "POST",                                                                    
                                },
                                order: [[2, 'asc']],
                                columnDefs: [{
                                    targets: ["_all"],
                                    orderable: true
                                }],                               
                                buttons: [
                                    'print',
                                    'copyHtml5',
                                    'excelHtml5',
                                    'csvHtml5',
                                    'pdfHtml5'
                                ],
                                "pageLength": 10,
                                "responsive": true,
                                                                                                                         
                            });

                            $("#export_print").on("click", function(e) {
                                    e.preventDefault(), s.button(0).trigger()
                                }),
                                $("#export_copy").on("click", function(e) {
                                    e.preventDefault(), s.button(1).trigger()
                                }),
                                $("#export_excel").on("click", function(e) {
                                    e.preventDefault(), s.button(2).trigger()
                                }),
                                $("#export_csv").on("click", function(e) {
                                    e.preventDefault(), s.button(3).trigger()
                                }),
                                $("#export_pdf").on("click", function(e) {
                                    e.preventDefault(), s.button(4).trigger()
                                });
                                
                        });
                    </script>
                    -->
                    <script>
                        $(document).ready(function() {
                            var std = $('#std_table').DataTable({
                                searching: false,
                                ordering: false,
                                paging: false,
                                buttons: [
                                    'print',
                                    'copyHtml5',
                                    'excelHtml5',
                                    'csvHtml5',
                                    'pdfHtml5'
                                ],
                            });
                            $("#export_print").on("click", function(e) {
                                    e.preventDefault(), std.button(0).trigger()
                                }),
                                $("#export_copy").on("click", function(e) {
                                    e.preventDefault(), std.button(1).trigger()
                                }),
                                $("#export_excel").on("click", function(e) {
                                    e.preventDefault(), std.button(2).trigger()
                                }),
                                $("#export_csv").on("click", function(e) {
                                    e.preventDefault(), std.button(3).trigger()
                                }),
                                $("#export_pdf").on("click", function(e) {
                                    e.preventDefault(), std.button(4).trigger()
                                });



                            $(document).on('submit', '#fas_event_form', function(e) {
                                e.preventDefault();
                                var form_data = $(this).serialize();
                                $.ajax({
                                    url: 'action.php',
                                    method: 'post',
                                    data: form_data,
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#fas_event').html(data.message);
                                        $('#export').attr('href', data.msg);
                                        $('#export_t').attr('href', data.ms);

                                    }
                                });
                            });

                        });
                    </script>
                </body>

                </html>
<?php
            }
        }
    }
} else {
    Redirect::to('../index.php');
}
?>