<?php
$response = array();
if(isset($_POST['qf_lgr_id']) && isset($_POST['comment'])){
		
	$qf_lgr_id = $_POST['qf_lgr_id'];
	$comment = $_POST['comment'];
	
	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	$query = "INSERT INTO `question_attachments`(`qf_lgr_id`, `lgr_comment_or_file_path`) VALUES ('".$qf_lgr_id."','".$comment."')";
	$result = mysqli_query($con, $query);
	if($result){
		$response["success"] = true;
		$response["message"] = "Successfully Added";
		echo json_encode($response);
	}
		
}else{
	$response["success"] = false;
	$response["message"] = "Error";
	echo json_encode($response);
}
?>