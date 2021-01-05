<?php

$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

if (isset($_POST['qfsu_id']) && isset($_POST['rating_id'])){
	$qfsu_id = $_POST["qfsu_id"];
    $rating_id = $_POST["rating_id"];
	
	$query = "UPDATE `question_for_spacific_users` SET `status`=1,`rate_id`=$rating_id,`date`= now() WHERE `question_for_spacific_users`.`qfsu_id`=$qfsu_id";
	$result = mysqli_query($con, $query);
	if ($result){
		$response["success"] = true;
		$response["message"] = "Question Rated Successfully";
		echo json_encode($response);
        
	}else{
		$response["success"] = false;
		$response["message"] = "Please try again";  
		echo json_encode($response);
	}

}
else{
	$response["success"] = false;
    $response["message"] = "Server side error";  
	echo json_encode($response);
}
?>

