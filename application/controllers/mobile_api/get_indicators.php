<?php

$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

$sql_query = "SELECT `id`, `name`, `img_name`, `color_hex` FROM `functions` where `parent_id`=0;";  
$result = mysqli_query($con,$sql_query);

if (mysqli_num_rows($result) > 0) {
		
	$role_id = $_POST['role_id'];
	if($role_id==10){
		$response["success"] = true;
		if (isset($_POST['user_id'])){
			$user_id = $_POST['user_id'];
			$sql_query = "SELECT `functions`.`id` , `functions`.`name` , `functions`.`img_name` , `functions`.`color_hex` , COUNT(`functions`.`name`) AS total FROM `question_for_spacific_users` INNER JOIN `functions` ON `question_for_spacific_users`.`function_id` = `functions`.`id` INNER JOIN `question` ON `question_for_spacific_users`.`ques_id` = `question`.`ques_id` WHERE `question_for_spacific_users`.`user_id`= $user_id AND `question_for_spacific_users`.`status`=0 AND `question`.`end_date`>= CURRENT_DATE GROUP BY `functions`.`name`";
			$result_total = mysqli_query($con,$sql_query);
			$response["question_count"] = array();
			while ($row = mysqli_fetch_array($result_total)) {
				$countt = array();
				$countt["id"] = $row["id"];
				$countt["total"] = $row["total"];
				array_push($response["question_count"], $countt);
			}
		}
	}
	else if($role_id==11){
		$response["success"] = true;
		if (isset($_POST['user_id'])){
			$user_id = $_POST['user_id'];
			$sql_query = "SELECT `functions`.`id` , `functions`.`name` , `functions`.`img_name` , `functions`.`color_hex` , COUNT(`functions`.`name`) AS total FROM `question_for_lgr` INNER JOIN `functions` ON `question_for_lgr`.`function_id` = `functions`.`id` INNER JOIN `question` ON `question_for_lgr`.`ques_id` = `question`.`ques_id` WHERE `question_for_lgr`.`user_id`= $user_id AND `question_for_lgr`.`status`=0 AND (`question`.`end_date`< CURRENT_DATE AND `question`.`lgr_last_date`>=CURRENT_DATE) GROUP BY `functions`.`name`";
			$result_total = mysqli_query($con,$sql_query);
			$response["question_count"] = array();
			while ($row = mysqli_fetch_array($result_total)) {
				$countt = array();
				$countt["id"] = $row["id"];
				$countt["total"] = $row["total"];
				array_push($response["question_count"], $countt);
			}
		}
	}
	
	$response["indicators_list"] = array();
    
	while ($row = mysqli_fetch_array($result)) {
		$indicator = array();
		$indicator["id"] = $row["id"];
		$indicator["name"] = $row["name"];
		$indicator["img_name"] = $row["img_name"];
		$indicator["color_hex"] = $row["color_hex"];
		array_push($response["indicators_list"], $indicator);
	}
	// echo JSON response
	echo json_encode($response);
}
else
{			
	$response["success"] = false;
	$response["message"] = "No Indicator available yet.";

	echo json_encode($response);
}
?>
