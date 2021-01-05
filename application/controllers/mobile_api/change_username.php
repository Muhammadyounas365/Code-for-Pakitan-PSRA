<?php
// cek form
$response = array();
if (isset($_POST['user_id']) && isset($_POST['user_name']) && isset($_POST['change_user_name']) ) 
    {
	$user_id = $_POST['user_id'];
	$user_name = $_POST['user_name'];
	$change_user_name = $_POST['change_user_name'];
	
    // include db connect
    require_once 'db_connect.php';
	
    // insert into db
    $result = mysqli_query($con,"SELECT user_name FROM users WHERE user_id=$user_id;");

    if ($result) {
        // success response
		$row = mysqli_fetch_assoc($result); 
		if($user_name == $row["user_name"]){
            $result = mysqli_query($con,"UPDATE `users` SET `user_name`='".$change_user_name."' WHERE `user_id`='".$user_id."';");
			if($result){
				$response["success"] = true;
				$response["message"] = "Username Change Successfully";
			}
			else{
				$response["success"] = false;
				$response["message"] = "Please try again";
			}
		}
		else{
			$response["success"] = false;
			$response["message"] = "Wrong Username";
		}
        
        // echoing JSON response
        echo json_encode($response);
    } 
} else {
    $response["success"] = false;
    $response["message"] = "No Record Found.";

    // echoing JSON response
    echo json_encode($response);
}
	
?>