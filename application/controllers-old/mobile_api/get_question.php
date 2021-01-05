<?php

$response = array();
if (isset($_POST['user_id']) && isset($_POST['indicator_id']) && isset($_POST['role_id'])){
	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	mysqli_query($con,'SET CHARACTER SET utf8');
	$user_id = $_POST['user_id'];
	$role_id = $_POST['role_id'];
	$indicator_id = $_POST['indicator_id'];
	
	if($role_id==10){
		$sql_query = "SELECT question_for_spacific_users.qfsu_id,question.ques_id, question.ques_title, districts.districts_title, tehsils.tehsils_title, vcs.vcs_title, nhcs.nhcs_title, question.end_date, mohallas.mohallas_title FROM question JOIN districts ON question.district_id = districts.id LEFT JOIN tehsils ON question.tehsil_id = tehsils.id LEFT JOIN vcs ON question.vcs_id = vcs.id LEFT JOIN nhcs ON question.nhcs_id = nhcs.id LEFT JOIN mohallas ON question.mohalla_id = mohallas.id JOIN question_for_spacific_users ON question.ques_id = question_for_spacific_users.ques_id WHERE question.ques_id = question_for_spacific_users.ques_id AND question_for_spacific_users.user_id = $user_id AND question_for_spacific_users.status = 0 AND `question`.`end_date`>= CURRENT_DATE AND question.indecator = $indicator_id ORDER BY question.ques_id DESC;";  
		$result = mysqli_query($con, $sql_query);

		if (mysqli_num_rows($result) > 0) {
		
			$response["success"] = true;
			$response["question_list"] = array();
    
			while ($row = mysqli_fetch_array($result)) {
				$question = array();
				$question["qfsu_id"] = $row["qfsu_id"];
				$question["ques_id"] = $row["ques_id"];
				$question["ques_title"] = $row["ques_title"];
				$question["districts_title"] = $row["districts_title"];
				$question["tehsils_title"] = $row["tehsils_title"];
				$question["vcs_title"] = $row["vcs_title"];
				$question["nhcs_title"] = $row["nhcs_title"];
				$question["end_date"] = $row["end_date"];
				$question["mohallas_title"] = $row["mohallas_title"];
				array_push($response["question_list"], $question);
			}
			$sql_query1 = "SELECT `id`, `rate_value`, `rate_title` FROM `rating`;"; 
 
			$result1 = mysqli_query($con,$sql_query1);
			if (mysqli_num_rows($result1) > 0) {
	
				$response["rating_list"] = array();
    
				while ($row = mysqli_fetch_array($result1)) {
					$rate = array();
					$rate["id"] = $row["id"];
					$rate["rate_value"] = $row["rate_value"];
					$rate["rate_title"] = $row["rate_title"];
					array_push($response["rating_list"], $rate);
				}
			}
			// echo JSON response
			echo json_encode($response);
		}
		else
		{			
			$response["success"] = false;
			$response["message"] = "No Questions available yet.";

			echo json_encode($response);
		}
	}
	if($role_id==11){
		$sql_query = "SELECT question_for_lgr.qf_lgr_id,question.ques_id, question.ques_title, districts.districts_title, tehsils.tehsils_title, vcs.vcs_title, nhcs.nhcs_title, question.lgr_last_date, mohallas.mohallas_title FROM question JOIN districts ON question.district_id = districts.id LEFT JOIN tehsils ON question.tehsil_id = tehsils.id LEFT JOIN vcs ON question.vcs_id = vcs.id LEFT JOIN nhcs ON question.nhcs_id = nhcs.id LEFT JOIN mohallas ON question.mohalla_id = mohallas.id JOIN question_for_lgr ON question.ques_id = question_for_lgr.ques_id WHERE question.ques_id = question_for_lgr.ques_id AND question_for_lgr.user_id = $user_id AND question_for_lgr.status = 0 AND (`question`.`end_date`< CURRENT_DATE AND `question`.`lgr_last_date`>=CURRENT_DATE) AND question.indecator = $indicator_id ORDER BY question.ques_id DESC;";  
		$result = mysqli_query($con, $sql_query);

		if (mysqli_num_rows($result) > 0) {
		
			$response["success"] = true;
			$response["question_list"] = array();
    
			while ($row = mysqli_fetch_array($result)) {
				$question = array();
				$question["qfsu_id"] = $row["qf_lgr_id"];
				$question["ques_id"] = $row["ques_id"];
				$question["ques_title"] = $row["ques_title"];
				$question["districts_title"] = $row["districts_title"];
				$question["tehsils_title"] = $row["tehsils_title"];
				$question["vcs_title"] = $row["vcs_title"];
				$question["nhcs_title"] = $row["nhcs_title"];
				$question["end_date"] = $row["lgr_last_date"];
				$question["mohallas_title"] = $row["mohallas_title"];
				$id = $row["ques_id"];
				$query_total ="SELECT COUNT(`question_for_spacific_users`.`status`) AS total FROM `question_for_spacific_users` WHERE `question_for_spacific_users`.`ques_id` = $id";
				$result_total = mysqli_query($con, $query_total);
				$total = mysqli_fetch_array($result_total);
				$question["total_cm"] = $total["total"];

				$query_rated = "SELECT COUNT(`question_for_spacific_users`.`status`) AS total_rated FROM `question_for_spacific_users` WHERE `question_for_spacific_users`.`ques_id` = $id AND `question_for_spacific_users`.`status` = 1";
				$result_rated = mysqli_query($con, $query_rated);
				$total_rated = mysqli_fetch_array($result_rated);
				$question["total_cm_rated"] = $total_rated["total_rated"];

				$query_un_rated = "SELECT COUNT(`question_for_spacific_users`.`status`) AS total_un_rated FROM `question_for_spacific_users` WHERE `question_for_spacific_users`.`ques_id` = $id AND `question_for_spacific_users`.`status` = 0";
				$result_un_rated = mysqli_query($con, $query_un_rated);
				$total_un_rated = mysqli_fetch_array($result_un_rated);
				$question["total_cm_un_rated"] = $total_un_rated["total_un_rated"];

				$query = 'SELECT `rating`.`title_english` from `rating` WHERE `rating`.`id`=1';
				$result1 = mysqli_query($con, $query);
				$roww = mysqli_fetch_array($result1);
				$result1 = $roww["title_english"];
				$query = 'SELECT `rating`.`title_english` from `rating` WHERE `rating`.`id`=2';
				$result2 = mysqli_query($con, $query);
				$roww = mysqli_fetch_array($result2);
				$result2 = $roww["title_english"];
				$query = 'SELECT `rating`.`title_english` from `rating` WHERE `rating`.`id`=3';
				$result3 = mysqli_query($con, $query);
				$roww = mysqli_fetch_array($result3);
				$result3 = $roww["title_english"];
				$query = 'SELECT `rating`.`title_english` from `rating` WHERE `rating`.`id`=4';
				$result4 = mysqli_query($con, $query);
				$roww = mysqli_fetch_array($result4);
				$result4 = $roww["title_english"];
				$query = 'SELECT `rating`.`title_english` from `rating` WHERE `rating`.`id`=5';
				$result5 = mysqli_query($con, $query);
				$roww = mysqli_fetch_array($result5);
				$result5 = $roww["title_english"];
				
				$query="SELECT
                    COUNT(`question_for_spacific_users`.`status`) AS total_rated,
                    SUM(`question_for_spacific_users`.`rate_id`) AS total_sum,
                    (
                      SUM(`question_for_spacific_users`.`rate_id`) / COUNT(`question_for_spacific_users`.`rate_id`)
                    ) AS Total_Score,
                    IF(
                      SUM(`question_for_spacific_users`.`rate_id`) / COUNT(`question_for_spacific_users`.`rate_id`) > 4,
                      '$result5',
                      IF(
                        SUM(`question_for_spacific_users`.`rate_id`) / COUNT(`question_for_spacific_users`.`rate_id`) > 3,
                        '$result4',
                        IF(
                          SUM(`question_for_spacific_users`.`rate_id`) / COUNT(`question_for_spacific_users`.`rate_id`) > 2,
                          '$result3',
                          IF(
                            SUM(`question_for_spacific_users`.`rate_id`) / COUNT(`question_for_spacific_users`.`rate_id`) > 1,
                            '$result2',
                            '$result1'
                          )
                        )
                      )
                    ) AS Overall_Performance
                    FROM
                    `question_for_spacific_users`
                    WHERE `question_for_spacific_users`.`ques_id` = '".$id."'
                    AND `question_for_spacific_users`.`status` = 1";
				$query_result = mysqli_query($con, $query);
				$query_result = mysqli_fetch_array($query_result);
				$question["Overall_Performance"] = $query_result["Overall_Performance"];

				array_push($response["question_list"], $question);
				
			}
			$sql_query1 = "SELECT `response_id`, `response_value`, `response_title` FROM `responses`;"; 
 
			$result1 = mysqli_query($con,$sql_query1);
			if (mysqli_num_rows($result1) > 0) {
	
				$response["rating_list"] = array();
    
				while ($row = mysqli_fetch_array($result1)) {
					$rate = array();
					$rate["id"] = $row["response_id"];
					$rate["rate_value"] = $row["response_value"];
					$rate["rate_title"] = $row["response_title"];
					array_push($response["rating_list"], $rate);
				}
			}
			$sql_query1 = "SELECT `sub_response_id`, `sub_response_value`, `sub_response_title`, `type_id`, `response_id` FROM `sub_responses`;"; 
 
			$result1 = mysqli_query($con,$sql_query1);
			$response["isSubResponses"] = false;
			if (mysqli_num_rows($result1) > 0) {
				$response["isSubResponses"] = true;
				$response["sub_responses_list"] = array();
    
				while ($row = mysqli_fetch_array($result1)) {
					$sub_responses = array();
					$sub_responses["sub_response_id"] = $row["sub_response_id"];
					$sub_responses["sub_response_value"] = $row["sub_response_value"];
					$sub_responses["sub_response_title"] = $row["sub_response_title"];
					$sub_responses["type_id"] = $row["type_id"];
					$sub_responses["response_id"] = $row["response_id"];
					array_push($response["sub_responses_list"], $sub_responses);
				}
			}
			// echo JSON response
			echo json_encode($response);
		}
		else
		{			
			$response["success"] = false;
			$response["message"] = "No Questions available yet.";

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