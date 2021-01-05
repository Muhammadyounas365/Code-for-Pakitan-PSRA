<?php
// cek form
$response = array();
if (isset($_POST['user_id']) && isset($_POST['role_id']) && isset($_POST['user_title']) && isset($_POST['user_email']) && isset($_POST['user_name'])&& isset($_POST['profile_picture']) && isset($_POST['gender']) && isset($_POST['birth_date']) && isset($_POST['cnic']) && isset($_POST['education']) && isset($_POST['designation']) && isset($_POST['contact_number']) && isset($_POST['district_id']) && isset($_POST['tehsil_id'])&& isset($_POST['nhc_id'])&& isset($_POST['vc_id'])&& isset($_POST['mohalla_id'])&& isset($_POST['user_password'])) 
    {
	$user_id = $_POST['user_id'];
	$role_id = $_POST['role_id'];
	$user_title = $_POST['user_title'];
	$gender = $_POST['gender'];
	$profile_picture = $_POST['profile_picture'];
	$birth_date = $_POST['birth_date'];
	$cnic = $_POST['cnic'];
	$education = $_POST['education'];
	$district_id = $_POST['district_id'];
	$tehsil_id = $_POST['tehsil_id'];
	$nhc_id = $_POST['nhc_id'];
	$vc_id = $_POST['vc_id'];
	$mohalla_id = $_POST['mohalla_id'];
	$contact_number = $_POST['contact_number'];
	$user_name = $_POST['user_name'];
	$designation = $_POST['designation'];
    $user_password = $_POST['user_password'];
	if($_POST['user_email']==''){
	    $query = "INSERT INTO `user_updates`(`role_id`,`user_id`,`user_title`, `user_name`,`user_password`,`profile_picture` ,`gender`,`birth_date`, `cnic`,`education`,`designation`,`contact_number`,`district_id`,`tehsil_id`,`vc_id`,`nhc_id`,`mohalla_id`) VALUES ('".$role_id."','".$user_id."','".$user_title."','".$user_name."','".$user_password."','".$profile_picture."','".$gender."','".$birth_date."','".$cnic."','".$education."','".$designation."','".$contact_number."','".$district_id."','".$tehsil_id."','".$vc_id."','".$nhc_id."','".$mohalla_id."')";
	}
	else{
		$query = "INSERT INTO `user_updates`(`role_id`,`user_id`,`user_title`, `user_name`,`user_email`,`user_password`,`profile_picture` ,`gender`,`birth_date`, `cnic`,`education`,`designation`,`contact_number`,`district_id`,`tehsil_id`,`vc_id`,`nhc_id`,`mohalla_id`) VALUES ('".$role_id."','".$user_id."','".$user_title."','".$user_name."','".$user_email."','".$user_password."','".$profile_picture."','".$gender."','".$birth_date."','".$cnic."','".$education."','".$designation."','".$contact_number."','".$district_id."','".$tehsil_id."','".$vc_id."','".$nhc_id."','".$mohalla_id."')";
	}

    

    // include db connect
    require_once 'db_connect.php';
	
    // insert into db
    $result = mysqli_query($con,$query);

    if ($result) {
        // success response
        $response["success"] = true;
        $response["message"] = "Your Request for Profile Update is send";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // fkalo gagal
        $response["success"] = false;
        $response["message"] = "Your previous update is pending";
        
        // echoing JSON response
        echo json_encode($response);
		//echo mysqli_error($con);
    }
} else {
    $response["success"] = false;
    $response["message"] = "No Record Found.";

    // echoing JSON response
    echo json_encode($response);
}
	
?>