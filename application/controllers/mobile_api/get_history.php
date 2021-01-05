<?php

$response = array();
if (isset($_POST['user_id']) && isset($_POST['role_id'])){
	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	mysqli_query($con,'SET CHARACTER SET utf8');
	$user_id = $_POST['user_id'];
	$role_id = $_POST['role_id'];
	
	if($role_id==10){
		$sql_query = "SELECT question.ques_title, functions.name, districts.districts_title, tehsils.tehsils_title, vcs.vcs_title, nhcs.nhcs_title, mohallas.mohallas_title, question_for_spacific_users.date,rating.rate_title FROM question JOIN functions ON question.`indecator` = functions.id JOIN districts ON question.district_id = districts.id LEFT JOIN tehsils ON question.tehsil_id = tehsils.id LEFT JOIN vcs ON question.vcs_id = vcs.id LEFT JOIN nhcs ON question.nhcs_id = nhcs.id LEFT JOIN mohallas ON question.mohalla_id = mohallas.id JOIN question_for_spacific_users ON question.ques_id = question_for_spacific_users.ques_id JOIN rating ON question_for_spacific_users.`rate_id` = rating.id WHERE question.ques_id = question_for_spacific_users.ques_id AND question_for_spacific_users.user_id = $user_id AND question_for_spacific_users.status = 1 ORDER BY question.ques_id DESC;";  
		$result = mysqli_query($con, $sql_query);

		if (mysqli_num_rows($result) > 0) {
		
			$response["success"] = true;
			$response["history_list"] = array();
    
			while ($row = mysqli_fetch_array($result)) {
				$history = array();
				$history["ques_title"] = $row["ques_title"];
				$history["indicator_name"] = $row["name"];
				$history["districts_title"] = $row["districts_title"];
				$history["tehsils_title"] = $row["tehsils_title"];
				$history["vcs_title"] = $row["vcs_title"];
				$history["nhcs_title"] = $row["nhcs_title"];
				$history["date"] = $row["date"];
				$history["mohallas_title"] = $row["mohallas_title"];
				$history["rate_title"] = $row["rate_title"];
 
				array_push($response["history_list"], $history);
			}
 
			// echo JSON response
			echo json_encode($response);
		}
		else
		{			
			$response["success"] = false;
			$response["message"] = "No History available yet.";

			echo json_encode($response);
		}
	}
	else if($role_id==11){
		$sql_query = "SELECT question.ques_title, functions.name, districts.districts_title, tehsils.tehsils_title, vcs.vcs_title, nhcs.nhcs_title, mohallas.mohallas_title, question_for_lgr.dated,responses.response_title FROM question JOIN functions ON question.`indecator` = functions.id JOIN districts ON question.district_id = districts.id LEFT JOIN tehsils ON question.tehsil_id = tehsils.id LEFT JOIN vcs ON question.vcs_id = vcs.id LEFT JOIN nhcs ON question.nhcs_id = nhcs.id LEFT JOIN mohallas ON question.mohalla_id = mohallas.id JOIN question_for_lgr ON question.ques_id = question_for_lgr.ques_id JOIN responses ON question_for_lgr.`response_id` = responses.response_id WHERE question.ques_id = question_for_lgr.ques_id AND question_for_lgr.user_id = $user_id AND question_for_lgr.status = 1 ORDER BY question.ques_id DESC;";  
		$result = mysqli_query($con, $sql_query);

		if (mysqli_num_rows($result) > 0) {
		
			$response["success"] = true;
			$response["history_list"] = array();
    
			while ($row = mysqli_fetch_array($result)) {
				$history = array();
				$history["ques_title"] = $row["ques_title"];
				$history["indicator_name"] = $row["name"];
				$history["districts_title"] = $row["districts_title"];
				$history["tehsils_title"] = $row["tehsils_title"];
				$history["vcs_title"] = $row["vcs_title"];
				$history["nhcs_title"] = $row["nhcs_title"];
				$history["date"] = $row["dated"];
				$history["mohallas_title"] = $row["mohallas_title"];
				$history["rate_title"] = $row["response_title"];
 
				array_push($response["history_list"], $history);
			}
 
			// echo JSON response
			echo json_encode($response);
		}
		else
		{			
			$response["success"] = false;
			$response["message"] = "No History available yet.";

			echo json_encode($response);
		}
	}
}
else{
	 $response["success"] = false;
    $response["message"] = "Server side error";

    // echoing JSON response
    echo json_encode($response);
}
?>