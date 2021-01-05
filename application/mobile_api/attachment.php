<?php
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

	$image = $_POST['image'];
	$image_name = $_POST['name'];
	$qf_lgr_id = $_POST['qf_lgr_id'];
	
	$date = date('dmY');
	$time = date('his');
	$name = $image_name.$date.$time.".png";
	$path = ".././assets/images/".$name;

    
	file_put_contents($path,base64_decode($image));
	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	$query = "INSERT INTO `question_attachments`(`qf_lgr_id`, `lgr_comment_or_file_path`) VALUES ('".$qf_lgr_id."','".$name."')";
	$result = mysqli_query($con, $query);
	if($result){
	    $response["success"] = true;
	    $response["message"] = "Attachment Uploaded";
	    echo json_encode($response);
	}
	else{
	    $response["success"] = false;
	    $response["message"] = "Attachment Uploading fail, please try again";
    	echo json_encode($response);
	}
	
		
}else{
	$response["success"] = false;
	$response["message"] = "Error";
	echo json_encode($response);
}
?>