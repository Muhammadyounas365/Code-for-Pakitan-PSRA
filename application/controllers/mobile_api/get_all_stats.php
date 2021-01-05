<?php

$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';
mysqli_query($con,'SET CHARACTER SET utf8');

if (isset($_POST['user_id']) && isset($_POST['role_id'])){
	$role_id = $_POST['role_id'];
	$user_id = $_POST['user_id'];
	if($role_id==10){
		$sql_query = "SELECT `id`,`name`, `color_hex` FROM `functions` where `parent_id`=0;";  
		$result_ind = mysqli_query($con,$sql_query);
	
		$sql_query = "SELECT `id`,`rate_title` FROM `rating`;";  
		$result_rat = mysqli_query($con,$sql_query);
	
		$query_total = "SELECT `status` FROM `question_for_spacific_users` WHERE `user_id`=$user_id;";
		$result_total = mysqli_query($con,$query_total);
		$result_total = mysqli_num_rows($result_total);
	
		if (mysqli_num_rows($result_ind) > 0||mysqli_num_rows($result_rat) > 0) {
			$response["success"] = true;
			$response["total"] = $result_total;
			$response["indicators_stats"] = array();
			$response["indicators_avg_stats"] = array();
			while ($row = mysqli_fetch_array($result_ind)) {
				$fun_id = $row["id"];
			
				$sql_query = "SELECT `functions`.`name`,`functions`.`color_hex`,COUNT(`question_for_spacific_users`.`function_id`) AS total FROM `question_for_spacific_users` JOIN `functions` ON `functions`.`id`=`question_for_spacific_users`.`function_id` WHERE `user_id`=$user_id AND `function_id`=$fun_id AND `status`=1;";
				$result_ind_stat = mysqli_query($con,$sql_query);
				$row1 = mysqli_fetch_array($result_ind_stat);
				$indicator_stat = array();
				$indicator_stat["name"] = $row1["name"];
				$indicator_stat["color_hex"] = $row1["color_hex"];
				$indicator_stat["total"] = $row1["total"];
				array_push($response["indicators_stats"], $indicator_stat);
			
				$sql_query = "SELECT `functions`.`name`,`functions`.`color_hex`,SUM(`question_for_spacific_users`.`rate_id`) / COUNT(`rating`.`rate_value`) AS average FROM `question_for_spacific_users` JOIN `functions` ON `functions`.`id`=`question_for_spacific_users`.`function_id` JOIN `rating` ON `rating`.`id`=`question_for_spacific_users`.`rate_id` WHERE `user_id`=$user_id AND `function_id`=$fun_id AND `status`=1;";  
				$result_ind_avg = mysqli_query($con,$sql_query);
				$row1 = mysqli_fetch_array($result_ind_avg);
				$indicator_avg_stat = array();
				$indicator_avg_stat["name"] = $row1["name"];
				$indicator_avg_stat["color_hex"] = $row1["color_hex"];
				$indicator_avg_stat["average"] = $row1["average"];
				array_push($response["indicators_avg_stats"], $indicator_avg_stat);
			}
			$response["rating_stats"] = array();
    
			while ($row = mysqli_fetch_array($result_rat)) {
				$rate_id = $row["id"];
				$sql_query = "SELECT `rating`.`rate_title`,COUNT(`rate_id`) AS total FROM `question_for_spacific_users` JOIN `rating` ON `rating`.`id`=`question_for_spacific_users`.`rate_id` WHERE `user_id`=$user_id AND `question_for_spacific_users`.`status`=1 AND `question_for_spacific_users`.`rate_id`=$rate_id;";
				$result_rate_stat = mysqli_query($con,$sql_query);
				$row1 = mysqli_fetch_array($result_rate_stat);

				$rating_stat = array();
				$rating_stat["rate_title"] = $row1["rate_title"];
				$rating_stat["total"] = $row1["total"];
				array_push($response["rating_stats"], $rating_stat);
			}
			echo json_encode($response);
		
		}
		else{
			$response["success"] = false;
			$response["message"] = "No data available yet.";

			echo json_encode($response);
		}
	}
	else if($role_id==11){
		$sql_query = "SELECT `id`,`name`, `color_hex` FROM `functions` where `parent_id`=0;";  
		$result_ind = mysqli_query($con,$sql_query);
	
		$sql_query = "SELECT `response_id`,`response_title` FROM `responses`;";  
		$result_rat = mysqli_query($con,$sql_query);
	
		$query_total = "SELECT `status` FROM `question_for_lgr` WHERE `user_id`=$user_id;";
		$result_total = mysqli_query($con,$query_total);
		$result_total = mysqli_num_rows($result_total);
	
		if (mysqli_num_rows($result_ind) > 0||mysqli_num_rows($result_rat) > 0) {
			$response["success"] = true;
			$response["total"] = $result_total;
			$response["indicators_stats"] = array();
			$response["indicators_avg_stats"] = array();
			while ($row = mysqli_fetch_array($result_ind)) {
				$fun_id = $row["id"];
			
				$sql_query = "SELECT `functions`.`name`,`functions`.`color_hex`,COUNT(`question_for_lgr`.`function_id`) AS total FROM `question_for_lgr` JOIN `functions` ON `functions`.`id`=`question_for_lgr`.`function_id` WHERE `user_id`=$user_id AND `function_id`=$fun_id AND `status`=1;";
				$result_ind_stat = mysqli_query($con,$sql_query);
				$row1 = mysqli_fetch_array($result_ind_stat);
				$indicator_stat = array();
				$indicator_stat["name"] = $row1["name"];
				$indicator_stat["color_hex"] = $row1["color_hex"];
				$indicator_stat["total"] = $row1["total"];
				array_push($response["indicators_stats"], $indicator_stat);
			
				$sql_query = "SELECT `functions`.`name`,`functions`.`color_hex`,SUM(`question_for_lgr`.`response_id`) / COUNT(`responses`.`response_value`) AS average FROM `question_for_lgr` JOIN `functions` ON `functions`.`id`=`question_for_lgr`.`function_id` JOIN `responses` ON `responses`.`response_id`=`question_for_lgr`.`response_id` WHERE `user_id`=$user_id AND `function_id`=$fun_id AND `status`=1;";  
				$result_ind_avg = mysqli_query($con,$sql_query);
				$row1 = mysqli_fetch_array($result_ind_avg);
				$indicator_avg_stat = array();
				$indicator_avg_stat["name"] = $row1["name"];
				$indicator_avg_stat["color_hex"] = $row1["color_hex"];
				$indicator_avg_stat["average"] = $row1["average"];
				array_push($response["indicators_avg_stats"], $indicator_avg_stat);
			}
			$response["rating_stats"] = array();
    
			while ($row = mysqli_fetch_array($result_rat)) {
				$rate_id = $row["response_id"];
				$sql_query = "SELECT `responses`.`response_title`,COUNT(`responses`.`response_id`) AS total FROM `question_for_lgr` JOIN `responses` ON `responses`.`response_id`=`question_for_lgr`.`response_id` WHERE `user_id`=$user_id AND `question_for_lgr`.`status`=1 AND `question_for_lgr`.`response_id`=$rate_id;";
				$result_rate_stat = mysqli_query($con,$sql_query);
				$row1 = mysqli_fetch_array($result_rate_stat);

				$rating_stat = array();
				$rating_stat["rate_title"] = $row1["response_title"];
				$rating_stat["total"] = $row1["total"];
				array_push($response["rating_stats"], $rating_stat);
			}
			echo json_encode($response);
		
		}
		else{
			$response["success"] = false;
			$response["message"] = "No data available yet.";

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
