<?php


require_once 'core/init.php';
require_once 'core/DB.php';
require_once '../includes/function.php';

$user = new Faculty();
$data = $user->data();

$message = '';
$error = '';
if (Input::exists()) {
    if (Input::get('action') == 'fac_event_search') {
        $query = '';
        $output = array();
        $dept_hash = $user->data()->fac_dept_hash;
        $query = 'SELECT * FROM `fac_event` WHERE fe_dept_hash = "' . $dept_hash . '" ';
        if (Input::get('e_activity')) {
            $query .= 'AND fe_activity LIKE "%' . $_POST["e_activity"] . '%" ';
        }
        if (Input::get('e_year')) {
            $query .= 'AND fe_year LIKE "%' . $_POST["e_year"] . '%" ';
        }
        if (Input::get('e_sdate')) {
            $query .= 'AND fe_s_date LIKE "%' . $_POST["e_sdate"] . '%" ';
        }
        if (Input::get('e_edate')) {
            $query .= 'AND fe_e_date LIKE "%' . $_POST["e_edate"] . '%" ';
        }

        $statement = $connect->prepare($query);

        $statement->execute();

        $result = $statement->fetchAll();
        $data = array();

        $filtered_rows = $statement->rowCount();
        $i = 0;
        foreach ($result as $row) {
            $i++;
            $fac = new Faculty($row["fe_fac_hash"]);
            $dept_image = '';
            if ($fac->data()->fac_image != '') {
                $dept_image = '
                        <div class="media">
                            <img src="data:image/jpeg;base64,' . base64_encode($fac->data()->fac_image) . '" class="mr-3" width="64" alt="' . $fac->data()->fac_name . '">
                            <div class="media-body">
                                <h5 class="mb-1">' . $fac->data()->fac_name . '</h5>
                                <span class="font-size-sm">' . $fac->data()->fac_designation . '(' . $fac->data()->fac_qualification . ')</span>
                            </div>
                        </div>';
            } else {
                $dept_image = '<div class="media">
                            <img src="../img/blank.png" class="mr-3" width="64" alt="' . $fac->data()->fac_name . '">
                            <div class="media-body">
                                <h5 class="mb-1">' . $fac->data()->fac_name . '</h5>
                                <span class="font-size-sm">' . $fac->data()->fac_designation . '(' . $fac->data()->fac_qualification . ')</span>
                            </div>
                        </div>';
            }
            if($row["fe_certificate"]){
                $cer_link = '<a href="'.$row["fe_certificate"].'" class="btn btn-sm btn-primary">View</a>';
            }else{
                $cer_link = '';
            }
            if($row["fe_file"]){
                $img_link = '<a href="upload/'.$row["fe_file"].'" class="btn btn-sm btn-danger">View</a>';
            }else{
                $img_link = '';
            }
            $sub_array = array();
            $sub_array[] = '<tr>';
            $sub_array[] = '<td>' . $i . '</td>';
            $sub_array[] = '<td>' . $dept_image . '</td>';
            $sub_array[] = '<td>' . $row["fe_name"] . '</td>';
            $sub_array[] = '<td>' . $row["fe_activity"] . '</td>';
            $sub_array[] = '<td>' . $row["fe_topic"] . '</td>';
            $sub_array[] = '<td>' . $row["fe_year"] . '</td>';
            $sub_array[] = '<td>' . $row["fe_s_date"] . '</td>';
            $sub_array[] = '<td>' . $row["fe_e_date"] . '</td>';
            $sub_array[] = '<td>' . $row["fe_venue"] . '</td>';
            $sub_array[] = '<td>' . $img_link . '</td>';
            $sub_array[] = '<td>' . $cer_link . '</td>';
            $sub_array[] = '</tr>';
            $data[] = $sub_array;
        }
        $datas = array(
            'message' => $data,
            'msg' => 'export.php?f='.convert_string('encrypt',$query),
            'ms' => 'export.php?p='.convert_string('encrypt',$query)
        );
        echo json_encode($datas);
    }

    if (Input::get('action') == 'fas_event_search') {
        $query = '';
        $output = array();
        $dept_hash = $user->data()->fac_dept_hash;
        $query = 'SELECT * FROM `fas_event` WHERE fe_dept_hash = "' . $dept_hash . '" ';
        if (Input::get('e_activity')) {
            $query .= 'AND fe_activity LIKE "%' . $_POST["e_activity"] . '%" ';
        }
        if (Input::get('e_year')) {
            $query .= 'AND fe_year LIKE "%' . $_POST["e_year"] . '%" ';
        }
        if (Input::get('e_sdate')) {
            $query .= 'AND fe_s_date LIKE "%' . $_POST["e_sdate"] . '%" ';
        }
        if (Input::get('e_edate')) {
            $query .= 'AND fe_e_date LIKE "%' . $_POST["e_edate"] . '%" ';
        }
        if (Input::get('e_mentor')) {
            $query .= 'AND fe_mentor_hash =  "'.convert_string('encrypt',Input::get('e_mentor')).'" ';
        }

        
        $statement = $connect->prepare($query);

        $statement->execute();

        $result = $statement->fetchAll();
        $data = array();

        $filtered_rows = $statement->rowCount();
        $i = 0;
        foreach ($result as $row) {
            $i++;
            $fac = new Student($row["fe_std_hash"]);
            if ($fac->data()->fac_year == 1) {
                $year = 'First Year';
            } elseif ($fac->data()->fac_year == 2) {
                $year = 'Second Year';
            } elseif ($fac->data()->fac_year == 3) {
                $year = 'Third Year';
            } else {
                $year = 'Final Year';
            }
            $dept_image = '';
            if ($fac->data()->fac_image != '') {
                $dept_image = '<div class="media">
                                    <img src="data:image/jpeg;base64,' . base64_encode($fac->data()->fac_image) . '" class="mr-3" width="64" alt="' . $fac->data()->fac_name . '">
                                    <div class="media-body">
                                        <h5 class="mb-1">' . $fac->data()->fac_name . '</h5>
                                        <span class="font-size-sm">' . $year . '</span>
                                    </div>
                                </div>';
            } else {
                $dept_image = '<div class="media">
                                <img src="../img/blank.png" class="mr-3" width="64" alt="' . $fac->data()->fac_name . '">
                                <div class="media-body">
                                    <h5 class="mb-1">' . $fac->data()->fac_name . '</h5>
                                    <span class="font-size-sm">' . $year . '</span>
                                </div>
                            </div>';
            }
            if($row["fe_cer_link"]){
                $cer_link = '<a href="'.$row["fe_cer_link"].'" class="btn btn-sm btn-primary">View</a>';
            }else{
                $cer_link = '';
            }
            if($row["fe_img_link"]){
                $img_link = '<a href="'.$row["fe_img_link"].'" class="btn btn-sm btn-danger">View</a>';
            }else{
                $img_link = '';
            }

            $sub_array = array();
            $sub_array[] = '<tr>';
            $sub_array[] = '<td>' . $i . '</td>';
            $sub_array[] = '<td>' . $dept_image . '</td>';
            $sub_array[] = '<td>' . $row["fe_name"] . '</td>';
            $sub_array[] = '<td>' . $row["fe_activity"] . '</td>';
            $sub_array[] = '<td>' . $row["fe_topic"] . '</td>';
            $sub_array[] = '<td>' . $row["fe_year"] . '</td>';
            $sub_array[] = '<td>' . $row["fe_s_date"] . '</td>';
            $sub_array[] = '<td>' . $row["fe_e_date"] . '</td>';
            $sub_array[] = '<td>' . $row["fe_venue"] . '</td>';
            $sub_array[] = '<td>' . $img_link . '</td>';
            $sub_array[] = '<td>' . $cer_link . '</td>';
            $sub_array[] = '</tr>';
            $data[] = $sub_array;
        }
        $datas = array(
            'message' => $data,
            'msg' => 'export.php?s='.convert_string('encrypt',$query),
            'ms' => 'export.php?t='.convert_string('encrypt',$query)
        );
        echo json_encode($datas);
    }

    if(Input::get('action') == 'profile_update'){
        $te_updated_at = date("h:i:sa");
        if (!empty($_FILES['ett_image']['tmp_name'])&& file_exists($_FILES['ett_image']['tmp_name'])) {
            $ett_image = file_get_contents($_FILES['ett_image']['tmp_name']);
        }

        if ($_FILES['ett_image']['error'] == 0) {
            $query = "UPDATE em_faculty SET fac_image = :d_image WHERE fac_passkey = :dept_pass ";
            $statement = $connect->prepare($query);
            $statement->execute(array(
                ':d_image' => $ett_image,
                ':dept_pass' => convert_string('encrypt',Input::get('ett_passkey'))
            ));
            $message .= "Image Updated<br>";
        }

        if(Input::get('te_name') != '' && Input::get('te_name') != $data->fac_name){
            $query = "SELECT fac_name FROM em_faculty WHERE fac_name = :_name";
            $statement = $connect->prepare($query);
            $statement->execute(array(
                ':_name' => Input::get('te_name'),
            ));
            if($statement->rowCount() > 0){
                $message .= "Faculty Name Exists<br>";
            }else{
                $query = "UPDATE em_faculty SET fac_name = :et_name, fac_updated_at = :ett_updated_at WHERE fac_passkey = :et_token";
                $statements = $connect->prepare($query);
                $statements->execute(
                    array(
                        ':et_name' => Input::get('te_name'),
                        ':et_token' => convert_string('encrypt',Input::get('ett_passkey')),
                        ':ett_updated_at' => $te_updated_at,
                    )
                ); 
                $message .= "Faculty Name Updated<br>";
            }
            
        }

        if(Input::get('te_username') != '' && Input::get('te_username') != $data->fac_username){
            $query = "SELECT fac_username FROM em_faculty WHERE fac_username = :_name";
            $statement = $connect->prepare($query);
            $statement->execute(array(
                ':_name' => Input::get('te_username'),
            ));
            if($statement->rowCount() > 0){
                $message .= "Department Name Exists<br>";
            }else{
                $query = "UPDATE em_faculty SET fac_username = :et_name, fac_updated_at = :ett_updated_at WHERE fac_passkey = :et_token";
                $statements = $connect->prepare($query);
                $statements->execute(
                    array(
                        ':et_name' => Input::get('te_username'),
                        ':et_token' => convert_string('encrypt',Input::get('ett_passkey')),
                        ':ett_updated_at' => $te_updated_at,
                    )
                ); 
                $message .= "Department Username Updated<br>";
            }
            
        }
        
        if(Input::get('te_designation') != '' && Input::get('te_designation') != $data->fac_designation){
            $query = "UPDATE em_faculty SET fac_designation = :et_name, fac_updated_at = :ett_updated_at WHERE fac_passkey = :et_token";
                $statements = $connect->prepare($query);
                $statements->execute(
                    array(
                        ':et_name' => Input::get('te_designation'),
                        ':et_token' => convert_string('encrypt',Input::get('ett_passkey')),
                        ':ett_updated_at' => $te_updated_at,
                    )
                ); 
                $message .= "Designation Updated<br>";
            
        }

        if (Input::get('te_qualification') != '' && Input::get('te_qualification') != $data->fac_qualification) {
            $query = "UPDATE em_faculty SET fac_qualification = :et_name, fac_updated_at = :ett_updated_at WHERE fac_passkey = :et_token";
                $statements = $connect->prepare($query);
                $statements->execute(
                    array(
                        ':et_name' => Input::get('te_qualification'),
                        ':et_token' => convert_string('encrypt',Input::get('ett_passkey')),
                        ':ett_updated_at' => $te_updated_at,
                    )
                ); 
                $message .= "Qualification Updated<br>";
        }

        if (Input::get('te_address') != '' && Input::get('te_address') != $data->fac_address) {
            $query = "UPDATE em_faculty SET fac_address = :et_name, fac_updated_at = :ett_updated_at WHERE fac_passkey = :et_token";
                $statements = $connect->prepare($query);
                $statements->execute(
                    array(
                        ':et_name' => Input::get('te_address'),
                        ':et_token' => convert_string('encrypt',Input::get('ett_passkey')),
                        ':ett_updated_at' => $te_updated_at,
                    )
                ); 
                $message .= "Address Updated<br>";
        }
        
        if (Input::get('te_phone') != '' && Input::get('te_phone') == $data->fac_phone) {
        } else {
            $query = "SELECT fac_phone FROM em_faculty WHERE fac_phone = :ett_phone";
            $statement = $connect->prepare($query);
            $statement->execute(
                array(
                    ':ett_phone' => Input::get('te_phone'),
                )
            );
            $row = $statement->rowCount();
            if ($row > 0) {
                $error .= 'Sorry! Phone no already registered<br>';
            } else {
                $query = "UPDATE em_faculty SET fac_phone = :ett_phone WHERE fac_passkey = :ett_token";
                $statement = $connect->prepare($query);
                $statement->execute(
                    array(
                        ':ett_phone' => Input::get('te_phone'),
                        ':ett_token' => convert_string('encrypt',Input::get('ett_passkey'))
                    )
                );
                $result = $statement->fetchAll();
                if (isset($result)) {
                    /*
                    $ett_number = '+91'. $_POST["te_phone"];
                    $ett_name = $_POST["te_name"];
                    // Your Account SID and Auth Token from twilio.com/console
                    $account_sid = 'ACaa3b76c388e4ac6f3bdb1bf870369f5c';
                    $auth_token = 'f6d6a5f5e456053dbe2464b78cf1fe7a';
                    // In production, these should be environment variables. E.g.:
                    // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

                    // A Twilio number you own with SMS capabilities
                    $twilio_number = "+12074219132";
                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create(
                        // Where to send a text message (your cell phone?)
                        $ett_number,
                        array(
                            'from' => $twilio_number,
                            'body' => 'Hello,' .$ett_name.  ' Your New Phone Number has been updated!'
                        )
                    );
                    */
                    $message .= 'New Phone No Updated<br>';
                } else {
                    $error .= 'Error! While Updating New Phone No<br>';
                }
            }
        }

        if (Input::get('te_email') != '' && Input::get('te_email') == $data->fac_email) {
        } else {
            $query = "SELECT fac_email FROM em_faculty WHERE fac_email = :ett_email";
            $statement = $connect->prepare($query);
            $statement->execute(
                array(
                    ':ett_email' => Input::get('te_email'),
                )
            );
            $row = $statement->rowCount();
            if ($row > 0) {
                $message .= 'Sorry! Email already registered<br>';
            } else {
                $query = "UPDATE em_faculty SET fac_email = :ett_email WHERE fac_passkey = :ett_token";
                $statement = $connect->prepare($query);
                $statement->execute(
                    array(
                        ':ett_email' => Input::get('te_email'),
                        ':ett_token' => convert_string('encrypt',Input::get('ett_passkey'))
                    )
                );
                $result = $statement->fetchAll();
                if (isset($result)) {
                    
                    $message .=  "Department Email Updated";
                } else {
                    $error .= 'Error! While Updating Email<br>';
                }
            }
        }


        $data = array(
            'message' => $message,
            'error' => $error
        );
        echo json_encode($data);
    }

    if(Input::get('action') == 'password_update'){
        if(Input::get('old_password')){
            if(convert_string('encrypt',Input::get('old_password')) == $data->fac_password){
                if(convert_string('encrypt',Input::get('new_password')) == convert_string('encrypt',Input::get('con_password'))){
                    if(convert_string('encrypt',Input::get('new_password')) != $data->fac_password){
                        $query = "UPDATE em_faculty SET fac_password = :_pass WHERE fac_passkey = :_passkey";
                        $statement = $connect->prepare($query);
                        if($statement->execute(array(
                            ':_pass' => convert_string('encrypt',Input::get('new_password')),
                            ':_passkey' => convert_string('encrypt',Input::get('ett_passkey'))
                        ))){
                            $message = "Password Updated";
                            $user->logout();
                        }else {
                            $error = "Somthing Went Wrong!";
                        }
                        
                    }else {
                        $error = "New Password is same as old!";
                    }
                }else{
                    $error = "New Password and Confirm Password not match";
                }
            }else{
                $error = "Old Password not match";
            }
        }

        $data = array(
            'message' => $message,
            'error' => $error
        );
        echo json_encode($data);
    }
}
