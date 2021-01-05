<?php

$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';
if (isset($_POST['user_id']) && isset($_POST['role_id'])){
	$role_id = $_POST['role_id'];
	$user_id = $_POST['user_id'];
	if($role_id==10){
		
		$query_total = "SELECT `status` FROM `question_for_spacific_users` WHERE `user_id`=$user_id;";
		$result_total = mysqli_query($con,$query_total);

		if ($result_total) {
			$result_total = mysqli_num_rows($result_total);

			$response["success"] = true;
			$response["total"] = $result_total;
    
			$query_rate = "SELECT COUNT(`status`) AS total FROM `question_for_spacific_users` WHERE `status`=1 AND `user_id`=$user_id;";
			$result_rate = mysqli_query($con,$query_rate);
			$row = mysqli_fetch_array($result_rate);
			$response["rate"] = $row["total"];
	
			$query_un_rate = "SELECT COUNT(`question_for_spacific_users`.`status`) AS total FROM `question_for_spacific_users` WHERE `question_for_spacific_users`.`status`=0 AND `user_id`=$user_id";
			$result_un_rate = mysqli_query($con,$query_un_rate);
			$row = mysqli_fetch_array($result_un_rate);
			$response["un_rate"] = $row["total"];

			// echo JSON response
			echo json_encode($response);
		}
		else
		{			
			$response["success"] = false;
			$response["message"] = "No Question Rated Yet!";

			echo json_encode($response);
		}
	}
	else if($role_id==11){
		$query_total = "SELECT `status` FROM `question_for_lgr` WHERE `user_id`=$user_id;";
		$result_total = mysqli_query($con,$query_total);

		if ($result_total) {
			$result_total = mysqli_num_rows($result_total);

			$response["success"] = true;
			$response["total"] = $result_total;
    
			$query_rate = "SELECT COUNT(`status`) AS total FROM `question_for_lgr` WHERE `status`=1 AND `user_id`=$user_id;";
			$result_rate = mysqli_query($con,$query_rate);
			$row = mysqli_fetch_array($result_rate);
			$response["rate"] = $row["total"];
	
			$query_un_rate = "SELECT COUNT(`question_for_lgr`.`status`) AS total FROM `question_for_lgr` WHERE `question_for_lgr`.`status`=0 AND `user_id`=$user_id";
			$result_un_rate = mysqli_query($con,$query_un_rate);
			$row = mysqli_fetch_array($result_un_rate);
			$response["un_rate"] = $row["total"];

			// echo JSON response
			echo json_encode($response);
		}
		else
		{			
			$response["success"] = false;
			$response["message"] = "No Question Rated Yet!";

			echo json_encode($response);
		}
	}
}
else{
	$response["success"] = false;
    $response["message"] = "Server side error";  
	echo json_encode($response);
}
?>
