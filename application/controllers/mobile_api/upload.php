<?php 


if($_SERVER['REQUEST_METHOD']=='POST'){

//header('Content-Type: image/png; charset=utf-8');
	$image = $_POST['image'];
	$image_name = $_POST['profile_picture'];

	$date = date('dmY');
	$time = date('his');
	$name = $image_name.$date.$time.".png";
//	$path = "/images/.$name";
	$path = ".././assets/images/".$name;
	
	$var = file_put_contents($path,base64_decode($image));
	if($var){
	$response["success"] = true;
	$response["profile_picture"] = $name;
	}
	else{
	    $response["success"] = false;
	    $response["message"] = "Please try again";
	}
	echo json_encode($response);
		
}else{
	$response["success"] = false;
	$response["message"] = "Profile Picture Uploading fail, try Again";
	echo json_encode($response);
}

?>