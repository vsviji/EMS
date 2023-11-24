<?php

require_once 'core/init.php';
require_once 'core/DB.php';
require_once '../includes/function.php';

$user = new Faculty();
if ($user->isLoggedIn()) {
    $data = $user->data();

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
                                <?php }else{ ?>
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
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php">Home</a>
                                </li>
                                <?php if($data->fac_role == 'HOD'){ ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Faculty</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="fac_overview.php?hash=<?php echo convert_string('decrypt',$data->fac_passkey) ?>">Overview</a></li>
                                        <li class="dropdown-divider"></li>                                        
                                        <li><a class="dropdown-item" href="fac_event_report.php?hash=<?php echo convert_string('decrypt',$data->fac_passkey) ?>">Event Report</a></li>                                        
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Student</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="fas_overview.php?hash=<?php echo convert_string('decrypt',$data->fac_passkey) ?>">Overview</a></li>
                                        <li class="dropdown-divider"></li>                                        
                                        <li><a class="dropdown-item" href="fas_event_report.php?hash=<?php echo convert_string('decrypt',$data->fac_passkey) ?>">Event Report</a></li>                                        
                                    </ul>
                                </li>
                                <?php }else{ ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Faculty</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="fac_overview.php?hash=<?php echo convert_string('decrypt',$data->fac_passkey) ?>">Overview</a></li>
                                        <li class="dropdown-divider"></li>                                        
                                        <li><a class="dropdown-item" href="fac_event_create.php?hash=<?php echo convert_string('decrypt',$data->fac_passkey) ?>">Event Participated</a></li>                                        
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Student</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="fas_overview.php?hash=<?php echo convert_string('decrypt',$data->fac_passkey) ?>">Overview</a></li>
                                        <li class="dropdown-divider"></li>                                        
                                        <li><a class="dropdown-item" href="fas_event_report.php?hash=<?php echo convert_string('decrypt',$data->fac_passkey) ?>">Event Report</a></li>                                        
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
                <div class="row">
                    <!-- Sidebar-->
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <div class="bg-light rounded-lg box-shadow-lg">
                            <div class="px-4 py-4 mb-1 text-center">
                                <?php if($data->fac_image){ ?> 
                                    <img class="d-block rounded-circle mx-auto my-2" width="110" src="data:image/png;base64,<?php echo base64_encode($data->fac_image) ?>" alt="<?php echo $data->fac_name ?>" />
                                <?php } ?>
                                
                                <h6 class="mb-0 pt-1"><?php echo $data->fac_name ?></h6>
                                <span class=" font-size-sm badge badge-danger text-white"><?php echo $data->fac_role ?></span>
                            </div>
                            <div class="d-lg-none px-4 pb-4 text-center">
                                <a class="btn btn-primary px-5 mb-2" href="#account-menu" data-toggle="collapse"><i class="fe-menu mr-2"></i>Account menu</a>
                            </div>                            
                            <div class="d-lg-block collapse pb-2" id="account-menu">
                                <?php if($data->fac_role == 'HOD'){ ?>
                                    <h3 class="d-block bg-secondary font-size-sm font-weight-semibold text-muted mb-0 px-4 py-3">
                                        Faculty
                                    </h3>
                                    <a class="d-flex align-items-center nav-link-style px-4 py-3" href="fac_overview.php?hash=<?php echo convert_string('decrypt',$data->fac_passkey) ?>">
                                        Overview
                                    </a>
                                    <a class="d-flex align-items-center nav-link-style px-4 py-3" href="fac_event_report.php?hash=<?php echo convert_string('decrypt',$data->fac_passkey) ?>">
                                        Event Report
                                    </a>
                                    <h3 class="d-block bg-secondary font-size-sm font-weight-semibold text-muted mb-0 px-4 py-3">
                                        Student
                                    </h3>
                                    <a class="d-flex align-items-center nav-link-style px-4 py-3" href="fas_overview.php?hash=<?php echo convert_string('decrypt',$data->fac_passkey) ?>">
                                        Overview
                                    </a>
                                    <a class="d-flex align-items-center nav-link-style px-4 py-3" href="fas_event_report.php?hash=<?php echo convert_string('decrypt',$data->fac_passkey) ?>">
                                        Event Report
                                    </a>
                                    <?php }else{ ?>
                                        <h3 class="d-block bg-secondary font-size-sm font-weight-semibold text-muted mb-0 px-4 py-3">
                                            Faculty
                                        </h3>
                                        <a class="d-flex align-items-center nav-link-style px-4 py-3" href="fac_overview.php?hash=<?php echo convert_string('decrypt',$data->fac_passkey) ?>">
                                            Overview
                                        </a>
                                        <a class="d-flex align-items-center nav-link-style px-4 py-3" href="fac_event_create.php?hash=<?php echo convert_string('decrypt',$data->fac_passkey) ?>">
                                            Event Participated
                                        </a>
                                        <h3 class="d-block bg-secondary font-size-sm font-weight-semibold text-muted mb-0 px-4 py-3">
                                            Student
                                        </h3>
                                        <a class="d-flex align-items-center nav-link-style px-4 py-3" href="fas_overview.php?hash=<?php echo convert_string('decrypt',$data->fac_passkey) ?>">
                                            Overview
                                        </a>
                                        <a class="d-flex align-items-center nav-link-style px-4 py-3" href="fas_event_report.php?hash=<?php echo convert_string('decrypt',$data->fac_passkey) ?>">
                                            Student Event Report
                                        </a>
                                   <?php } ?>
                                                                
                                <h3 class="d-block bg-secondary font-size-sm font-weight-semibold text-muted mb-0 px-4 py-3">
                                    Dashboard
                                </h3>                                
                                <a class="d-flex align-items-center nav-link-style px-4 py-3 active" href="index.php">Profile info</a>
                                <a class="d-flex align-items-center nav-link-style px-4 py-3 border-top" href="change_password.php">Change Password</a>
                                <a class="d-flex align-items-center nav-link-style px-4 py-3 border-top" href="message.php">Message</a>
                                <div class="d-flex align-items-center border-top">
                                    <a class="d-block w-100 nav-link-style px-4 py-3" href="account-notifications.html">Notifications</a>
                                    <div class="ml-auto px-3">
                                        <div class="custom-control custom-switch">
                                            <input class="custom-control-input" type="checkbox" id="notifications-switch" data-master-checkbox-for="#notification-settings" checked />
                                            <label class="custom-control-label" for="notifications-switch"></label>
                                        </div>
                                    </div>
                                </div>
                                <a class="d-flex align-items-center nav-link-style px-4 py-3 border-top" href="logout.php"><i class="fe-log-out font-size-lg opacity-60 mr-2"></i>Sign out</a>
                            </div>
                        </div>
                    </div>
                    <!-- Content-->
                    <div class="col-lg-8">
                        <div class="d-flex flex-column h-100 bg-light rounded-lg box-shadow-lg p-4">
                            <div class="py-2 p-md-3">
                                <!-- Title + Delete link-->
                                <div class="d-sm-flex align-items-center justify-content-between pb-4 text-center text-sm-left">
                                    <h1 class="h3 mb-2 text-nowrap">Profile info</h1>
                                    <a class="btn btn-link text-danger font-weight-medium btn-sm mb-2" href="#"><i class="fe-trash-2 font-size-base mr-2"></i>Delete account
                                    </a>
                                </div>
                                <p id="alert" class="text-center d-none mb-2 mt-2 text-danger h6 font-weight-bold"></p>
                                <form method="post" enctype="multipart/form-data" id="profile_info" class="needs-validation" novalidate>
                                    <!-- Content-->
                                    <div class="bg-secondary rounded-lg p-4 mb-4">
                                        <div class="media d-block d-sm-flex align-items-center">
                                            <?php if($data->fac_image){ ?> 
                                                <img class="d-block rounded-circle mx-auto mb-3 mb-sm-0" width="110" src="data:image/png;base64,<?php echo base64_encode($data->fac_image) ?>" alt="<?php echo $data->fac_name ?>" />
                                            <?php }else{ ?>
                                                <img src="../img/blank.png" class="d-block rounded-circle mx-auto mb-3 mb-sm-0" width="110"  alt="<?php echo $row->fac_name ?>">
                                            <?php } ?>                                        
                                            <div class="media-body pl-sm-3 text-center text-sm-left">
                                                <label for="file-input">Change Image</label>
                                                <div class="custom-file">
                                                    <input class="custom-file-input" type="file" id="file-input" name="ett_image">
                                                    <label class="custom-file-label" for="file-input">Change avatar</label>
                                                </div>
                                                <div class="p mb-0 font-size-ms text-muted">
                                                    Upload JPG, GIF or PNG image, 600 X 600 required.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="account-fn">Faculty Name</label>
                                                <input class="form-control" type="text" id="account-fn" name="te_name" value="<?php echo $data->fac_name ?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="account-ln">Designation</label>
                                                <input class="form-control" type="text" id="account-ln" name="te_designation" value="<?php echo $data->fac_designation ?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="account-email">Email address</label>
                                                <input class="form-control" type="text" id="account-email" name="te_email" value="<?php echo $data->fac_email ?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="account-username">Username</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">@</span>
                                                    </div>
                                                    <input class="form-control" type="text" id="account-username" name="te_username" value="<?php echo $data->fac_username ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="fa_phone">Phone</label>
                                                <input class="form-control" type="text" id="fa_phone" name="te_phone" value="<?php echo $data->fac_phone ?>" />
                                            </div>
                                        </div>                                                                     
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="fa_qualification">Qualification</label>
                                                <input class="form-control" type="text" id="fa_qualification" name="te_qualification" value="<?php echo $data->fac_qualification ?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="fa_address">Address</label>
                                                <input class="form-control" type="text" id="fa_address" name="te_address" value="<?php echo $data->fac_address ?>" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr class="mt-2 mb-4" />
                                            <div class="d-flex flex-wrap justify-content-end align-items-center">                                                
                                                <input type="hidden" name="action" value="profile_update">
                                                <input type="hidden" name="ett_passkey" value="<?php echo convert_string('decrypt', $data->fac_passkey) ?>">
                                                <button class="btn btn-primary mt-3 mt-sm-0 float-right" type="submit">
                                                    <i class="fe-save font-size-lg mr-2"></i>Save changes
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
        <a class="btn-scroll-top" href="#top" data-scroll>
            <span class="btn-scroll-top-tooltip text-muted font-size-sm mr-2">Top</span>
            <i class="btn-scroll-top-icon fe-arrow-up"></i>
        </a>
        <!-- Vendor scrits: js libraries and plugins-->
        <script src="../vendor/jquery/dist/jquery.slim.min.js"></script>
        <script src="../vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
        <script src="../vendor/simplebar/dist/simplebar.min.js"></script>
        <script src="../vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
        <script src="../vendor/flatpickr/dist/flatpickr.min.js"></script>
        <script src="../vendor/flatpickr/dist/plugins/rangePlugin.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Main theme script-->
        <script src="../js/theme.min.js"></script>
        <script>
            $(document).ready(function() {
                $(document).on('submit', '#profile_info', function(e) {
                    e.preventDefault();
                    var form_data = new FormData(this);
                    $.ajax({
                        url: "action.php",
                        method: "post",
                        data: form_data,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function(data) {
                            if (data.message) {
                                
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                                
                            } else {
                                $('#alert').removeClass('d-none');
                                $('#alert').html(data.error);
                            }
                        }
                    })
                });
            });
        </script>
    </body>

    </html>
<?php

} else {
    Redirect::to('../index.php');
}
?>